<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ToolController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () { return view('welcome'); })->name('welcome');

// Zone Auteurs
Route::get('/auteurs', [AuthorController::class, 'welcome'])->name('auteurs');
Route::get('/auteurs/index/{i}', [AuthorController::class, 'index']);
Route::get('/auteurs/pays/{name}', [AuthorController::class, 'pays']);
Route::get('/auteurs/{name}', [AuthorController::class, 'page']);

// Zone infos du site
Route::get('/site', [AnnouncementController::class, 'welcome'])->name('site');
Route::get('/site/news', [AnnouncementController::class, 'news']);
Route::get('/site/base', [AnnouncementController::class, 'stats']);
Route::get('/site/merci', [AnnouncementController::class, 'thanks']);
Route::get('/site/aides', [AnnouncementController::class, 'help']);
Route::get('/site/a-propos', [AnnouncementController::class, 'about']);

// Temporaire
Route::get('/festivals', function () { return view('festivals'); });
// Zone salons et autres évènements
Route::get('/evenements', [EventController::class, 'welcome'])->name('evenements');
// Route::get('/evenements', ...);              --> accueil + évènements à venir
// Route::get('/evenements/{name}', ...);       --> détail d'un événement (périodique ou non)
// Route::get('/evenements/historique', ...);   --> Liste des évènements y compris passés

// Temporaire
Route::get('/prix', function () { return view('prix'); });
// Zone récompenses
// Route::get('/prix', ...);              --> L'accueil, la liste des prix, par pays
// Route::get('/prix/{name}', ...);       --> La page d'un prix

// Temporaire
Route::get('/ouvrages', function () { return view('ouvrages'); });
// Zone ouvrages
// Route::get('/ouvrages', ...);        --> accueil ouvrages
// Route::get('/textes/{name}', ...);   --> page d'un ouvrage => id ou slug

// Temporaire
Route::get('/textes', function () { return view('textes'); });
// Zone textes
// Route::get('/textes', ...);          --> accueil textes
// Route::get('/textes/{name}', ...);   --> page d'un texte => id ou slug

// Temporaire
Route::get('/series', function () { return view('series'); });
// Zone cycles et séries
// Route::get('/series', ...);              --> l'accueil séries
// Route::get('/series/index/{i}', ...);    --> Index série {initiale} (y compris 0 ou 9)
// Route::get('/series/{name}', ...);       --> Une page série => slug !

// Temporaire
Route::get('/collections', function () { return view('collections'); });
// Zone collections
// Route::get('/collections', ...);             --> accueil
// Route::get('/collections/index/{i}', ...);   --> Index série {initiale} (y compris 0 ou 9)
// Route::get('/collections/{name}', ...);      --> Une page collection => slug !

// Temporaire
Route::get('/editeurs', function () { return view('editeurs'); });
// Zone éditeurs
// Route::get('/editeurs', ...);            --> accueil
// Route::get('/editeurs/index/{i}', ...);  --> Index série {initiale} (y compris 0 ou 9)
// Route::get('/editeurs/{name}', ...);     --> Une page collection => slug !

// Forums => redirection sur sous-domaine en PHP 5.6
// Temporaire
Route::get('/forums', function () { return view('forums'); });

// Authentification
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Accès restreint aux roles "user" (si existe)
    // ...

    // Accès pour la zone admin :
    Route::middleware(['auth.bdfiadmin'])->group(function () {

        Route::get('/admin', function () { return view('admin/welcome'); })->name('admin');
        Route::get('/admin/rapports', [ReportController::class, 'index'])->name('admin/rapports');
        Route::get('/admin/rapports/dates-bizarres', [ReportController::class, 'getStrangeDates']);
        Route::get('/admin/rapports/manque-date-naissance', [ReportController::class, 'getMissingBirthdates']);
        Route::get('/admin/rapports/manque-date-deces', [ReportController::class, 'getMissingDeathdates']);
        Route::get('/admin/rapports/etat-biographies-{i}', [ReportController::class, 'getBioStatus']);
        Route::get('/admin/rapports/manque-nationalite', [ReportController::class, 'getMissingCountries']);
        Route::get('/admin/rapports/manque-fiche', [ReportController::class, 'getMissingRecords']);

        Route::get('/admin/outils', [ToolController::class, 'index'])->name('admin/outils');
        Route::get('/admin/outils/anniversaires-fb-jour', [ToolController::class, 'getFbToday']);
        Route::get('/admin/outils/anniversaires-fb-semaine', [ToolController::class, 'getFbWeek']);
        Route::get('/admin/outils/anniversaires-fb-mois', [ToolController::class, 'getFbMonth']);
        Route::get('/admin/outils/conversion-sommaire', [ToolController::class, 'getConvertContent']);

// Gestion des Téléchargement tables - générique multi-modèle
        Route::get('admin/telechargements', ['as' => 'downloads', function() {
            return View('admin.telechargements.index');
        }]);

        Route::get('admin/telechargements/{model}', function($model) {
        //  TBD - tout le code à revoir (même si fonctionne aujourd'hui)
        // ...  passer par un contrôleur au moins
            
        //  TBC voir si fonctionne sur site sans majuscule
        //  $modele = ucfirst($model);

        // TBD : il faudrait contrôler qu'il s'agit bien d'un modèle existant

        // Nom du fichier tel qu'il sera téléchargé
            $filename = "${model}_" . date ("Y-m-d") . '.csv';
            $headers = [
                'Content-type' => 'application/csv',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Content-type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename,
                'Expires' =>'0',
                'Pragma' =>'public'
            ];

        // Appel de "all" sur le modèle générique fourni
            $ucmodel = ucfirst($model);
            if ($ucmodel == "Urlauteur") { $ucmodel = "UrlAuteur"; }
            if ($ucmodel == "Lienauteur") { $ucmodel = "LienAuteur"; }

            $collection = call_user_func(array("App\\Models\\$ucmodel", 'all'));
            $table = $collection->toArray();

        # Ajout des noms de colonne en première ligne
            array_unshift($table, array_keys($table[0]));

        # Balayage de la table pour écrire dans le stream
            $callback = function() use ($table) {
                $handle = fopen('php://output', 'w');
                foreach ($table as $row) {
                    fputcsv($handle, str_replace(array("\r\n", "\n", "\r"), ' ', $row), ";", '"');
                }
                fclose($handle);
            };
            return Response::stream($callback, 200, $headers);
        });

    });
});
