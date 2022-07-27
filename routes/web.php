<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('home');
});

// Route::get('/user', function () {
//     return view('user');
// });
// Route::get('/cart', function () {
//     return view('cart');
// });

//-----------------------------------------------------AUTHENTICATION----------------------------------------------------------
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
#Route for user role based login
Route::get('/redirect', [HomeController::class,'redirect']);

//-----------------------------------------------CUSTOMER---------------------------------------------------------------------

//Index Equipment
use App\Http\Controllers\Customer\EquipmentlistingController; //Added
Route::get('Customer/equipmentlistings', [EquipmentlistingController::class, 'index']);// Displays all equipment listings
//Show Equipment
Route::get('Customer/equipmentlistings/{equipmentID}', [EquipmentlistingController::class, 'show']);// Displays Single equipment listing based on ID

//---------------------------------------------------ADMIN---------------------------------------------------------------------
//1. Dashboard
use App\Http\Controllers\Admin\Admindashboard; //Added
Route::get('Admin/dashboard', [Admindashboard::class, 'index']);

//2. Reports
use App\Http\Controllers\Admin\Reports; //Added
Route::get('Admin/reports', [Reports::class, 'index']);

//3. Equipment Listing
use App\Http\Controllers\Admin\AdminlistingController; //Added
//Index
Route::get('Admin/equipmentlistings', [AdminlistingController::class, 'indexAccepted']);// Displays all accepted equipment listings
Route::get('Admin/equipmentlistings/pending', [AdminlistingController::class, 'indexPending']);// Displays all equipment listings requests
Route::get('Admin/equipmentlistings/rejected', [AdminlistingController::class, 'indexRejected']);// Displays all accepted equipment listings
//Show
Route::get('Admin/equipmentlistings/{equipmentID}', [AdminlistingController::class, 'show']);// Displays Single equipment listing based on ID
//'Delete'
Route::post('Admin/equipmentlistings/{equipmentID}', [AdminlistingController::class, 'destroy']);
//4. User
use App\Http\Controllers\Admin\AdminuserController; //Added
//Index
Route::get('Admin/users/requests', [AdminuserController::class, 'indexRegrequests']);
Route::get('Admin/users/customers', [AdminuserController::class, 'indexCustomers']);
Route::get('Admin/users/equipmentowners', [AdminuserController::class, 'indexOwners']);
Route::get('Admin/users/removed', [AdminuserController::class, 'indexRemoved']);
//Show
Route::get('Admin/users/{userID}', [AdminuserController::class, 'show']);
Route::get('Admin/users/{role}/{userID}', [AdminuserController::class, 'showRating']);
//Remove User
//'Delete'
Route::post('Admin/users/{userID}', [AdminuserController::class, 'remove']);
//Accept or reject registration request
Route::post('Admin/users/accepted/{userID}', [AdminuserController::class, 'accept']);
Route::post('Admin/users/rejected/{userID}', [AdminuserController::class, 'reject']);

Route::get('Admin', [AdminuserController::class, 'indexAdmin']);
Route::get('Admin/create', [AdminuserController::class, 'createAdmin']);
Route::post('Admin/create', [AdminuserController::class, 'storeAdmin']);

//5. Quality Inspector
use App\Http\Controllers\Admin\AdmininspectorController; //Added
//Index
Route::get('Admin/inspectors/inspectors', [AdmininspectorController::class, 'indexInspectors']);
Route::get('Admin/inspectors/jobs', [AdmininspectorController::class, 'indexJobs']);
Route::get('Admin/inspectors/untasks', [AdmininspectorController::class, 'indexUnassignedTasks']);
//'Delete'
Route::post('Admin/inspectors/remove/{userID}', [AdmininspectorController::class, 'remove']);
//Show
Route::get('Admin/inspectors/jobs/{IJID}', [AdmininspectorController::class, 'show']);
Route::get('Admin/inspectors/jobfor/{userID}', [AdmininspectorController::class, 'showInspectorJobs']);
//Create 
Route::get('Admin/inspectors/create', [AdmininspectorController::class, 'createInspector']);
Route::post('Admin/inspectors/create', [AdmininspectorController::class, 'storeInspector']);
Route::get('Admin/inspectors/createjob', [AdmininspectorController::class, 'createJob']);
Route::post('Admin/inspectors/createjob', [AdmininspectorController::class, 'storeJob']);
Route::get('Admin/inspectors/assigntasks/{IJID}', [AdmininspectorController::class, 'assignTasks']);
Route::post('Admin/inspectors/assigntasks', [AdmininspectorController::class, 'assign']);

//6. Rentals
use App\Http\Controllers\Admin\AdminrentalController; //Added
Route::get('Admin/rentals/requests', [AdminrentalController::class, 'index']);
Route::get('Admin/rentals/rejectrequests', [AdminrentalController::class, 'indexRejects']);
Route::get('Admin/rentals/starting', [AdminrentalController::class, 'indexStart']);
Route::get('Admin/rentals/ongoing', [AdminrentalController::class, 'indexOngoing']);
Route::get('Admin/rentals/past', [AdminrentalController::class, 'indexPast']);

//7. Orders
use App\Http\Controllers\Admin\AdminorderController; //Added
Route::get('Admin/orders/paid', [AdminorderController::class, 'indexPaid']);
Route::get('Admin/orders/notpaid', [AdminorderController::class, 'indexNotpaid']);
Route::get('Admin/orders/{orderID}', [AdminorderController::class, 'show']);

//7. Ratings and Reviews
use App\Http\Controllers\Admin\AdminrrController; //Added
Route::get('Admin/ratingsreviews/customers', [AdminrrController::class, 'indexCustomers']);
Route::get('Admin/ratingsreviews/owners', [AdminrrController::class, 'indexOwners']);
Route::get('Admin/ratingsreviews/lowrated', [AdminrrController::class, 'indexUsers']);
Route::get('Admin/ratingsreviews/customers/{userID}', [AdminrrController::class, 'showCustomers']);
Route::get('Admin/ratingsreviews/owners/{userID}', [AdminrrController::class, 'showOwners']);

//----------------------------------------------------INSPECTOR----------------------------------------------------------------

//1. Dashboard
use App\Http\Controllers\Inspector\Inspectordashboard; //Added
Route::get('Inspector/dashboard', [Inspectordashboard::class, 'index']);
//2. Inspection Jobs
use App\Http\Controllers\Inspector\InspectorjobController;
Route::get('Inspectors/jobs/past', [InspectorjobController::class, 'indexPastJobs']);
Route::get('Inspectors/jobs/pending', [InspectorjobController::class, 'indexPendingJobs']);
Route::get('Inspectors/jobs/assigned', [InspectorjobController::class, 'indexAssignedJobs']);
//Show
Route::get('Inspectors/jobs/{IJID}', [InspectorjobController::class, 'show']);
Route::get('Inspectors/equipment/{IJID}/{ITID}/{equipmentID}', [InspectorjobController::class, 'add']);
Route::post('Inspectors/equipment/{equipmentID}', [InspectorjobController::class, 'store']);
Route::get('Inspectors/rental/redirect/{IJID}/{ITID}/{rentalID}', [InspectorjobController::class, 'showRentalEquipment']);
Route::get('Inspectors/rental/{IJID}/{ITID}/{equipmentID}', [InspectorjobController::class, 'showEquipment']);
Route::get('Inspectors/rental/{equipmentID}/{ownerID}', [InspectorjobController::class, 'showUser']);

Route::post('Inspectors/rental/accepted/{IJID}/{ITID}/{rentalID}', [InspectorjobController::class, 'acceptRental']);
Route::post('Inspectors/rental/rejected/{IJID}/{ITID}/{rentalID}', [InspectorjobController::class, 'rejectRental']);

//3. Profile
use App\Http\Controllers\Inspector\Inspectorprofile; //Added
Route::get('Inspector/profile/{userID}', [Inspectorprofile::class, 'show']);
Route::get('Inspector/profile/edit/{userID}', [Inspectorprofile::class, 'edit']);
Route::post('Inspector/profile/edit', [Inspectorprofile::class, 'store']);

//-------------------------------------------------EQUIPMENT OWNER----------------------------------------------------------
//1. Dashboard
use App\Http\Controllers\Owner\Ownerdashboard; //Added
Route::get('Owner/dashboard', [Ownerdashboard::class, 'index']);

//2. Equipment Listings
use App\Http\Controllers\Owner\OwnerlistingController; //Added
//Index
Route::get('Owner/equipmentlistings', [OwnerlistingController::class, 'indexAccepted']);// Displays all accepted equipment listings
Route::get('Owner/equipmentlistings/pending', [OwnerlistingController::class, 'indexPending']);// Displays all equipment listings requests
Route::get('Owner/equipmentlistings/rejected', [OwnerlistingController::class, 'indexRejected']);
Route::get('Owner/equipmentlistings/removed', [OwnerlistingController::class, 'indexRemoved']);
//Show
Route::get('Owner/equipmentlistings/{equipmentID}', [OwnerlistingController::class, 'show']);// Displays Single equipment listing based on ID
//Create 
Route::get('Owner/listing/create', [OwnerlistingController::class, 'create']);
Route::post('Owner/listing/create', [OwnerlistingController::class, 'store']);
//Delete Equipment
Route::post('Owner/equipmentlistings/{equipmentID}', [OwnerlistingController::class, 'destroy']);
//Update
Route::get('Owner/equipmentlistings/edit/{equipmentID}', [OwnerlistingController::class, 'edit']);
Route::post('Owner/equipmentlistings/edit/{equipmentID}', [OwnerlistingController::class, 'updateListing']);
Route::get('Owner/equipmentlistings/edit/{equipmentID}/{availableStatus}', [OwnerlistingController::class, 'changeAvailability']);

//3. Inspections
use App\Http\Controllers\Owner\OwnerinspectionController; //Added
//Index
Route::get('Owner/inspections/tasks/listingrequests/upcoming', [OwnerinspectionController::class, 'indexUpcomingListingRequestTasks']);
Route::get('Owner/inspections/tasks/rentalrequests/upcoming', [OwnerinspectionController::class, 'indexUpcomingRentalRequestTasks']);
Route::get('Owner/inspections/tasks/listingrequests/completed', [OwnerinspectionController::class, 'indexCompletedListingRequestTasks']);
Route::get('Owner/inspections/tasks/rentalrequests/completed', [OwnerinspectionController::class, 'indexCompletedRentalRequestTasks']);
//Show
Route::get('Owner/inspectiontasks/{inspectorID}', [OwnerinspectionController::class, 'showInspector']);

//4. Rentals
use App\Http\Controllers\Owner\OwnerrentalController; //Added
//Index
Route::get('Owner/rentals/requests/pending', [OwnerrentalController::class, 'indexReqPending']);
Route::get('Owner/rentals/starting', [OwnerrentalController::class, 'indexRentalStart']);
Route::get('Owner/rentals/ongoing', [OwnerrentalController::class, 'indexRentalOngoing']);
Route::get('Owner/rentals/past', [OwnerrentalController::class, 'indexRentalPast']);
Route::get('Owner/rentals/requests/rejected', [OwnerrentalController::class, 'indexReqRejected']);
//Accept
Route::get('Owner/rental/{rentalID}/{status}/{equipmentID}', [OwnerrentalController::class, 'rentalResponse']);


//5. Ratings and Reviews
use App\Http\Controllers\Owner\OwnerrrController; //Added
//Index
Route::get('Owner/customers/ratingsreviews', [OwnerrrController::class, 'indexRRCustomers']);
Route::get('Owner/customers/ratingsreviews/pending', [OwnerrrController::class, 'indexRRPendingCustomers']);
Route::get('Owner/my/ratingsreviews', [OwnerrrController::class, 'indexMyRR']);
//Show
Route::get('Owner/customers/ratingsreviews/{userID}', [OwnerrrController::class, 'showCustomers']);
//Create - Give Rating and Reviews
Route::get('Owner/customers/ratingsreviews/create/{userID}/{rentalID}', [OwnerrrController::class, 'createRR']);
Route::post('Owner/customers/ratingsreviews/create', [OwnerrrController::class, 'saveRR']);

//6. Profile
use App\Http\Controllers\Owner\Ownerprofile; //Added
Route::get('Owner/profile/{userID}', [Ownerprofile::class, 'show']);
Route::get('Owner/profile/edit/{userID}', [Ownerprofile::class, 'edit']);
Route::post('Owner/profile/edit', [Ownerprofile::class, 'store']);