<?php

namespace App\Providers;

use App\Events\GenerateInvoiceEvent;
use App\Listeners\GenerateInvoiceListener;
use App\Repositories\AcademicYearRepository;
use App\Repositories\ExpenditureRepository;
use App\Repositories\FeesRepository;
use App\Repositories\Interfaces\AcademicYearRepositoryInterface;
use App\Repositories\Interfaces\ExpenditureRepositoryInterface;
use App\Repositories\Interfaces\FeesRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\PDFRepositoryInterface;
use App\Repositories\Interfaces\ReportsRepositoryInterface;
use App\Repositories\Interfaces\SClassRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TermRepositoryInterface;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\InvoiceRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\PDFRepository;
use App\Repositories\ReportsRepository;
use App\Repositories\SClassRepository;
use App\Repositories\StudentRepository;
use App\Repositories\TermRepository;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(FeesRepositoryInterface::class, FeesRepository::class);
        $this->app->bind(SClassRepositoryInterface::class, SClassRepository::class);
        $this->app->bind(AcademicYearRepositoryInterface::class, AcademicYearRepository::class);
        $this->app->bind(ExpenditureRepositoryInterface::class, ExpenditureRepository::class);
        $this->app->bind(TermRepositoryInterface::class, TermRepository::class);
        $this->app->bind(ReportsRepositoryInterface::class, ReportsRepository::class);
        $this->app->bind(PDFRepositoryInterface::class, PDFRepository::class);
        $this->app->bind(WebsiteRepositoryInterface::class, WebsiteRepository::class);
        $this->app->bind(InvoiceRepositoryInterface::class, InvoiceRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // app events and their mapped listeners
        // Event::listen(
        //     GenerateInvoiceEvent::class,
        //     GenerateInvoiceListener::class
        // );
    }
}
