<?php

namespace App\Providers;

use App\Constants\Status;
use App\Lib\Searchable;
use App\Models\AdminNotification;
use App\Models\Category;
use App\Models\Deposit;
use App\Models\Frontend;
use App\Models\RequestItem;
use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        Builder::mixin(new Searchable);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {

        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    
      // Disable install check on production (Railway)
if (app()->environment('local')) {
    if (!cache()->get('SystemInstalled')) {
        $envFilePath = base_path('.env');
        if (!file_exists($envFilePath)) {
            header('Location: install');
            exit;
        }
        $envContents = file_get_contents($envFilePath);
        if (empty($envContents)) {
            header('Location: install');
            exit;
        } else {
            cache()->put('SystemInstalled', true);
        }
    }
}
    
        view()->share([
            'emptyMessage' => 'Data not found',
        ]);
    
        // ✅ SAFE categories loader
        view()->composer('*', function ($view) {
            try {
                $categories = \App\Models\Category::active()->with([
                    'subcategories' => function ($subcategory) {
                        $subcategory->active();
                    },
                ])->get(['name', 'id']);
    
                $view->with('categories', $categories);
            } catch (\Exception $e) {
                $view->with('categories', collect());
            }
        });
    
        view()->composer('admin.partials.sidenav', function ($view) {
            $view->with([
                'bannedUsersCount'           => User::banned()->count() ?? 0,
                'emailUnverifiedUsersCount'  => User::emailUnverified()->count() ?? 0,
                'mobileUnverifiedUsersCount' => User::mobileUnverified()->count() ?? 0,
                'pendingTicketCount'         => SupportTicket::whereIn('status', [Status::TICKET_OPEN, Status::TICKET_REPLY])->count() ?? 0,
                'pendingDepositsCount'       => Deposit::pending()->count() ?? 0,
                'pendingRequestItemCount'    => RequestItem::pending()->count() ?? 0,
                'updateAvailable'            => false,
            ]);
        });
    
        view()->composer('admin.partials.topnav', function ($view) {
            $view->with([
                'adminNotifications'     => AdminNotification::where('is_read', Status::NO)->with('user')->latest()->take(10)->get() ?? collect(),
                'adminNotificationCount' => AdminNotification::where('is_read', Status::NO)->count() ?? 0,
            ]);
        });
    
        Paginator::useBootstrapFive();
    }
    
     
      
      /*
        view()->composer('partials.seo', function ($view) {
            try {
                $seo = Frontend::where('data_keys', 'seo.data')->first();
                $view->with([
                    'seo' => $seo ? $seo->data_values : null,
                ]);
            } catch (\Exception $e) {}
        });
    */
        // ❌ Disable this for now (causes issues)
        // if (gs('force_ssl')) {
        //     \URL::forceScheme('https');
        // }
    
      
  
}
