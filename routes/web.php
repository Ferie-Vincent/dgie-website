<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DossierController;
use App\Http\Controllers\Admin\EvenementController;
use App\Http\Controllers\Admin\FlashInfoController;
use App\Http\Controllers\Admin\GalerieController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\PollController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CulturalItemController;
use App\Http\Controllers\Admin\ToolkitItemController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\FaqItemController;
use App\Http\Controllers\Admin\MagazineController;

// Accueil
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Actualités
Route::get('/actualites', [\App\Http\Controllers\ActualiteController::class, 'index'])->name('actualites');
Route::get('/actualites/{slug}', [\App\Http\Controllers\ActualiteController::class, 'show'])->name('article.show');

// Sections principales
Route::get('/coin-des-diaspos', [\App\Http\Controllers\CoinDiasposController::class, 'index'])->name('coin-des-diaspos');
Route::get('/nos-services', [\App\Http\Controllers\InstitutionController::class, 'nosServices'])->name('nos-services');
Route::get('/la-dgie', [\App\Http\Controllers\InstitutionController::class, 'laDgie'])->name('la-dgie');
Route::get('/retour-reintegration', [\App\Http\Controllers\InstitutionController::class, 'retourReintegration'])->name('retour-reintegration');
Route::get('/investir-contribuer', [\App\Http\Controllers\InstitutionController::class, 'investirContribuer'])->name('investir-contribuer');
Route::get('/galerie', [\App\Http\Controllers\GalerieFrontController::class, 'index'])->name('galerie');
Route::get('/mediatheque', [\App\Http\Controllers\MediathequeController::class, 'index'])->name('mediatheque');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/evenements/{slug}', [\App\Http\Controllers\EvenementFrontController::class, 'show'])->name('event.show');

// Formulaires publics (rate-limited)
Route::post('/contact', [\App\Http\Controllers\FormSubmissionController::class, 'submitContact'])->middleware('throttle:3,10')->name('contact.submit');
Route::post('/newsletter', [\App\Http\Controllers\FormSubmissionController::class, 'subscribeNewsletter'])->middleware('throttle:3,10')->name('newsletter.subscribe');
Route::post('/commentaire', [\App\Http\Controllers\FormSubmissionController::class, 'submitComment'])->middleware('throttle:5,10')->name('comment.submit');
Route::post('/sondage/vote', [\App\Http\Controllers\FormSubmissionController::class, 'votePoll'])->middleware('throttle:5,10')->name('poll.vote');

// Recherche
Route::get('/recherche', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');

// Dossiers
Route::get('/dossiers', [\App\Http\Controllers\DossierFrontController::class, 'index'])->name('dossiers');
Route::get('/dossiers/{slug}', [\App\Http\Controllers\DossierFrontController::class, 'show'])->name('dossier.show');

// Pages légales
Route::get('/mentions-legales', [\App\Http\Controllers\InstitutionController::class, 'mentionsLegales'])->name('mentions-legales');
Route::get('/politique-confidentialite', [\App\Http\Controllers\InstitutionController::class, 'politiqueConfidentialite'])->name('politique-confidentialite');

// ============================================
// ADMIN
// ============================================

// Auth admin (public)
Route::get('/admin/login', [LoginController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

// Changement de mot de passe obligatoire (protégé par admin mais pas par force-password-change)
Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/changer-mot-de-passe', [LoginController::class, 'showChangePassword'])->name('password.change');
    Route::post('/changer-mot-de-passe', [LoginController::class, 'changePassword'])->name('password.update');
});

// Routes protégées admin
Route::prefix('admin')->middleware(['admin', 'force-password-change'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Redirect /admin to /admin/dashboard
    Route::redirect('/', '/admin/dashboard');

    // CRUD Resources
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('dossiers', DossierController::class);
    Route::resource('evenements', EvenementController::class);
    Route::resource('flash-infos', FlashInfoController::class);
    Route::resource('galerie', GalerieController::class)->except(['create', 'show', 'edit']);
    Route::resource('staff', StaffController::class);
    Route::resource('partners', PartnerController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('polls', PollController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('cultural-items', CulturalItemController::class);
    Route::resource('toolkit-items', ToolkitItemController::class);
    Route::resource('visuels', BannerController::class)->names('banners')->parameters(['visuels' => 'banner']);
    Route::resource('faqs', FaqItemController::class)->except(['create', 'show']);
    Route::resource('magazines', MagazineController::class)->except(['create', 'show']);

    // Commentaires (modération)
    Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
    Route::post('comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::post('comments/{comment}/reject', [CommentController::class, 'reject'])->name('comments.reject');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Messages de contact — Centre de messagerie
    Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::post('contact-messages/contact-info', [ContactMessageController::class, 'updateContactInfo'])->name('contact-messages.update-contact-info');
    Route::post('contact-messages/{contact_message}/mark-as-read', [ContactMessageController::class, 'markAsRead'])->name('contact-messages.mark-read');
    Route::post('contact-messages/{contact_message}/reply', [ContactMessageController::class, 'reply'])->name('contact-messages.reply');
    Route::delete('contact-messages/{contact_message}', [ContactMessageController::class, 'destroy'])->name('contact-messages.destroy');

    // Newsletter (lecture + suppression)
    Route::get('newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('newsletter/{subscriber}', [NewsletterController::class, 'destroy'])->name('newsletter.destroy');

    // Paramètres du site
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Utilisateurs (super-admin uniquement)
    Route::resource('utilisateurs', UserController::class)->except(['create', 'show', 'edit'])->middleware('superadmin');
});
