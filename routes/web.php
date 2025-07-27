        <?php

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\ProfileController;
        use App\Http\Controllers\ActivityController;
        use App\Http\Controllers\DashboardController;
        use App\Http\Controllers\ActivityFormController;

        /*
        |--------------------------------------------------------------------------
        | Web Routes
        |--------------------------------------------------------------------------
        |
        | Here is where you can register web routes for your application. These
        | routes are loaded by the RouteServiceProvider and all of them will
        | be assigned to the "web" middleware group. Make something great!
        |
        */

        Route::get('/', function () {
            return redirect()->route('login');
        });

        Route::middleware(['auth', 'role:admin'])->group(function () {
            Route::resource('forms', ActivityFormController::class); // CRUD form kegiatan
            Route::get('/activities', [ActivityController::class, 'index'])->name('admin.activities.index');
            Route::get('/forms/{activity}', [ActivityFormController::class, 'show'])->name('forms.show');
            Route::get('/forms/export/pdf', [ActivityFormController::class, 'exportPdf'])->name('forms.export.pdf');
            Route::get('/forms/export/excel', [ActivityFormController::class, 'exportExcel'])->name('forms.export.excel');
            Route::get('/forms/export/csv', [ActivityFormController::class, 'exportCsv'])->name('forms.export.csv');
        });

        Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
            Route::resource('activities', ActivityController::class); // CRUD aktivitas 
        });


        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->middleware(['auth', 'verified'])
            ->name('dashboard');

        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });

        require __DIR__ . '/auth.php';
