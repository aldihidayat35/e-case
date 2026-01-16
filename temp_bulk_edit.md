# Bulk Edit List - Student Violations & Rewards

## Files to Edit:
1. student-violations/index.blade.php - HAS BUTTON: Catat Pelanggaran Baru
2. student-violations/create.blade.php - NO BUTTON
3. student-violations/history.blade.php - NEED TO CHECK
4. student-violations/fines.blade.php - NEED TO CHECK
5. rewards/index.blade.php - HAS BUTTONS: Siswa Berhak & Berikan Penghargaan
6. rewards/create.blade.php - NO BUTTON  
7. rewards/eligible.blade.php - NEED TO CHECK
8. rewards/show.blade.php - NEED TO CHECK

## Pattern untuk replace:
OLD:
```
<!--begin::Toolbar-->
<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-3">
            <h1 class="d-flex text-white fw-bold my-1 fs-3">[TITLE]</h1>
            ...breadcrumb...
        </div>
    </div>
</div>
<!--end::Toolbar-->

<!--begin::Container-->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid" id="kt_content">
```

NEW (with button):
```
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">[TITLE]</h1>
            </div>
            <div>
                [BUTTONS HERE]
            </div>
        </div>
```

NEW (no button):
```
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <div class="mb-5">
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 my-0">[TITLE]</h1>
        </div>
```
