<?php 
  $pageTitle="All Audit List";
  include "include/navbar.php"; 
?>
  <style>
    .daterange-input {
      position: relative;
      display: inline-block;
    }
    .daterange-input input {
      width: 250px;
      padding-right: 40px;
      padding-left: 15px;
      border-radius: 25px;
      border: 1px solid #ced4da;
      box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.075);
      font-size: 16px;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .daterange-input input:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.25);
    }
    .daterange-input .calendar-icon,
    .daterange-input .reset-icon {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }
    .daterange-input .calendar-icon {
      right: 40px;
      color: #007bff;
      font-size: 18px;
    }
    .daterange-input .reset-icon {
      right: 10px;
      color: #dc3545;
      font-size: 18px;
      display: none;
    }
    .daterangepicker .drp-calendar.right {
      display: none;
    }
    .daterangepicker .drp-calendar.left {
      width: 100% !important;
    }
    
  </style>

<style>
#searchInput{
    width: 350px;
    margin: 0 10px 0 10px;
}
    .table-container {
        min-height: 600px;
        width: 100%;
        overflow-x: auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: var(--white-color);
        padding: 10px;
        border-radius: 8px;
        border: 2px solid #ddd;
    }
    .header-container {
            display: flex;
            justify-content: space-between; /* Spaces out title and button container */
            align-items: center;
            padding: 10px 10px 40px;
        }
        .header-title {
            font-size: 24px;
            font-weight: bold;
        }
        .button-container {
            display: flex;
            gap: 10px;

        }
        
        /* Media query for mobile devices */
        @media (max-width: 600px) {
            .header-title {
                display: none;
            }
            .header-container {
                justify-content: center;
                flex-wrap: wrap; 
            }
        }
    .data-container{
        min-height: 600px;
        background-color: var(--white-color);
        /* border: 1px solid #ddd; */
        overflow-x: auto;
        padding: 2px;
    }

    #dataTable {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    #dataTable tr td, #dataTable tr th {
    white-space: nowrap;
    }

    #dataTable th {
        border: 2px solid #ddd;
        padding: 8px;
        text-align: left;
        position: relative;
        cursor: pointer;
        background-color: var(--blue-white);
        color: var(--white-color);
        text-align: center;
    }
    #dataTable td {
        border: 2px solid #ddd;
        padding: 8px;
        text-align: left;
        position: relative;
    }

    .sort-up::before,
    .sort-down::before {
        content: '';
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
    }

    .sort-up::before {
        content: '\25b2'; /* Unicode for up arrow */
    }

    .sort-down::before {
        content: '\25bc'; /* Unicode for down arrow */
    }

    .status {
        padding: 2px 10px;
        border-radius: 10px;
        color: white;
        font-size: 13px;
    }

    .status.pending {
        background-color: #ff1493;
    }

    .status.inprogress {
        background-color: #ffd700;
        color: black;
    }

    .status.submited {
        background-color: #008000;
    }

    .status.submited {
        background-color: #800080;
    }

    .status.rejected {
        background-color: #ff0000;
    }

    .action-button {
        padding: 5px 10px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: white;
        background:#0037ff;
    }
    .action-button:hover {
        text-decoration: none;
        color: white;
        background:#344276;
    }
/* 
    .action-button.start-audit {
        background-color: #007bff;
    }

    .action-button.resume-audit {
        background-color: #a97e00;
    }

    .action-button.download-report {
        background-color: #006c05;
    }

    .action-button.review {
        background-color: #ff0000;
    }
    .action-button.open-progress {
        background-color: #720072;
    } */

    .pagination {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
    }

    .pagination a {
        margin: 0 5px;
        text-decoration: none;
        color: #007bff;
    }

    .pagination a:hover {
        text-decoration: underline;
    }

    .controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        overflow-x: auto;
        margin-bottom: 10px;
        max-width: auto;
        padding: 10px 5px;
    }

    .show-pages {
        display: flex;
        align-items: center;
    }
    .filter-data {
        display: flex;
        align-items: center;
    }
    .controllLabel {
        margin: 0 5px;
    }

    .controls input, .controls select {
        padding: 5px;
        margin-right: 10px;
        border-radius: 4px;
        border: 1.3px solid #959595;
    }
    th.sort-asc::after {
        content: ' 🔼';
    }
    
    th.sort-desc::after {
        content: ' 🔽';
    }
    /* Custom CSS for .form-control placeholder */
/* .form-control, ::placeholder{
  color: #b7b7b7;
  opacity: 1;
} */
.form-select .defaultSelect {
  color: #b7b7b7;
}
#dateRange[readonly] {
  background-color: #fcfcfc;
  color: #6c757d; 
  border: 1px solid #ced4da;
  opacity: 1;
}
.form-control:focus::placeholder {
  color: #666;
  font-style: normal;
}
#filterButton {
    position: relative;
  }
  
  #filterCount {
    position: absolute;
    top: -10px;
    right: -10px;
    background-color: red;
    color: white;
    padding: 1px 4px;
    border-radius: 50%;
    font-size: 12px;
  }
  /* datepicker calender area */
  .daterangepicker.show-calendar .drp-buttons{
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
    }
  .daterangepicker .drp-selected {
      display: inline-block;
      font-size: 12px;
      padding-right: 2px;
  }
  .daterangepicker {
    position: absolute;
    color: inherit;
    background-color: #f2f7f7;
    border-radius: 4px;
    border: 1px solid #8d8d8d;
    width: 370px;
    max-width: none;
    padding: 0;
    margin-top: 7px;
    top: 100px;
    left: 20px;
    z-index: 3001;
    display: none;
    font-family: arial;
    font-size: 15px;
    line-height: 1em;
}
.daterangepicker .calendar-table {
    border: 1px solid #c3c3c3;
    border-radius: 4px;
    background-color: #fdfdfd;
    width: 350px;
    height: auto;
    padding: 5px;
}
.daterangepicker .calendar-table th, .daterangepicker .calendar-table td {
    white-space: nowrap;
    text-align: center;
    vertical-align: middle;
    min-width: 32px;
    width: 32px;
    height: 24px;
    line-height: 24px;
    font-size: 17px;
    border-radius: 4px;
    border: 1px solid #efefef;
    white-space: nowrap;
    cursor: pointer;
}
  /* datepicker calender area end*/

    @media (max-width: 780px) {
        .show-pages{
            display: none;
        }
        #searchInput{
            max-width: 200px;
            margin-left: 10px
        }
        .controllLabel{
            display: none;
        }
    }

</style>

    <div class="table-container">
      <div class="header-container">
        <div class="header-title">List of All Audits</div>
          <div class="button-container">
            <button type="button" class="btn btn-danger mr-2" data-bs-toggle="modal" data-bs-target="#auditModal">
                <i class="fas fa-plus"></i> New Audit
            </button>
            <button type="button" class="btn btn-primary ml-2" id="exportData">
                <i class="fas fa-file-export"></i> Export Data
            </button>
          </div>
          <!-- <div id="message"></div> -->
        </div>
      <div class="controls">
        <div class="show-pages ml-4">
          <p class="controllLabel ml-3">show</p>
            <select id="entriesPerPage" onchange="changeEntriesPerPage()">
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
          <p class="controllLabel">entries</p>
        </div>
      <div class="search-container">
        <input type="text" id="searchInput" placeholder="Search..." oninput="searchTable()">
      </div>
      <div class="filter-data mr-4">
      <button type="button" class="btn btn-secondary btn-sm mr-2" id="filterButton" data-bs-toggle="modal" data-bs-target="#filterModal">
  <i class="fa-solid fa-filter"></i>
  <span id="filterCount" class="badge badge-light">0</span> Filter
</button>
          <!-- <button type="button" class="btn btn-secondary mr-2" data-target="#">
            <i class="fa-solid fa-filter-circle-xmark"></i>
          </button> -->
            <!-- <p class="controllLabel">Filter</p> -->
        <select id="filterStatus" hidden>
            <option value="all">All</option>
            <option value="submited">Submited</option>
            <option value="inprogress">Inprogress</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
      </div>
    </div>

    <div class="data-container">
      <table id="dataTable">
        <thead>
          <tr>
            <th data-column="sl" class="" id="header-index">SL No</th>
            <th data-column="auditNumber" class="sortable" id="header-audit_number">Audit Number <span class="sort-icon"></span></th>
            <th data-column="bcaId" class="sortable" id="header-bca_id">BCA ID <span class="sort-icon"></span></th>
            <th data-column="bcaFullName" class="sortable pl-3 pr-3" id="header-bca_full_name">BCA Full Name <span class="sort-icon"></span></th>
            <th data-column="bcaFullName" class="sortable pl-3 pr-3" id="header-mobile_no">Mobile No<span class="sort-icon"></span></th>
            <th data-column="bcaBank" class="sortable pl-3 pr-3" id="header-bca_bank">BCA Bank <span class="sort-icon"></span></th>
            <th data-column="bcaFullName" class="sortable" id="header-state">State <span class="sort-icon"></span></th>
            <th data-column="bcaFullName" class="sortable" id="header-location">Location <span class="sort-icon"></span></th>
            <th data-column="status" class="sortable" id="header-status">Audit Status <span class="sort-icon"></span></th>
            <th data-column="date" class="sortable" id="header-formatted_date">Audit Date <span class="sort-icon"></span></th>
            <th data-column="auditorName" class="sortable" id="header-created_by">Created By <span class="sort-icon"></span></th>
            <th data-column="actionButtons" class="">Action</th>
          </tr>
        </thead>
        <tbody id="dataTableBody">
            <!-- Rows will be dynamically generated by JavaScript -->
        </tbody>
      </table>
    </div>
    <div class="pagination">
      <div id="recordInfo">0 to 0 of 0 data</div>
      <div id="paginationControls"></div>
    </div>

<!-- Main From Header Close Bellow -->
</div>
</div>


<div class="all-modal-area">
  <!-- Filter data modal -->
  <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="dataFilterModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Filter Audit List</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form id="filterForm">
            <div class="row g-3">
              <!-- Date Range input Field -->
              <div class="col-md-6 position-relative">
                <label for="dateRange" class="form-label">Audit Date Range:</label>
                <input type="text" id="dateRange" class="form-control" readonly placeholder="Select date range">
              </div>
              <!-- State -->
              <div class="col-md-6">
                <label for="state" class="form-label">BCA State:</label>
                <select class="form-select" id="state" name="state">
                  <option value="">Select State</option>
                  <!-- Populate state options here -->
                </select>
              </div>
              <!-- Location -->
              <div class="col-md-6">
                <label for="location" class="form-label">BCA Location:</label>
                <select class="form-select" id="location" name="location">
                  <option value="">Select Location</option>
                  <!-- Populate location options here -->
                </select>
              </div>
              <!-- Bank -->
              <div class="col-md-6">
                <label for="bank" class="form-label">BCA Bank:</label>
                <select class="form-select" id="bank" name="bank">
                  <option value="">Select Bank</option>
                  <!-- Populate bank options here -->
                </select>
              </div>
              <!-- Created By -->
              <div class="col-md-6">
                <label for="createdBy" class="form-label">Audit Created By:</label>
                <select class="form-select" id="createdBy" name="createdBy">
                  <option value="">Select Created By</option>
                  <!-- Populate created by options here -->
                </select>
              </div>
              <!-- Status -->
              <div class="col-md-6">
                <label for="status" class="form-label">Audit Status:</label>
                <select class="form-select" id="status" name="status">
                  <option value="">Select Status</option>
                  <!-- Populate status options here -->
                </select>
              </div>
            </div>
          </form>
        </div>
        <!-- Modal Footer -->
        <div class="modal-footer justify-content-between pt-2 pb-2">
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                  <div>
                    <button type="button" class="btn btn-warning btn-sm mr-4" id="resetFilterForm">Reset</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="applyFilters()" data-bs-dismiss="modal">Apply</button>
                  </div>
            <!-- Modal Footer  end bellow-->
            </div> 
          <!-- Modal Content end bellow-->
          </div> 
        <!-- modal-dialog  end bellow-->
        </div>
        <!-- Filter Modal end bellow-->
      </div>
            
      <!-- New audit modal -->
      <div class="modal fade" id="auditModal" tabindex="-1" aria-labelledby="auditModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="auditModalLabel">Validate BCA ID</h4>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body pt-2 pb-3">

              <div class="form-group row justify-content-center">
                <div class="col-10">
                  <label for="bcaId">BCA ID</label>
                  <input type="text" class="form-control uppercase-input no-space" id="bcaId" name="bcaId" placeholder="Enter a BCA ID" required>
                </div>
              </div>
              <div class="form-group row justify-content-center">
                <div class="col-10">
                  <label for="bcaName">BCA Full Name</label>
                  <input type="text" class="form-control" id="bcaName" name="bcaName" placeholder="" required disabled>
                </div>
              </div>
                <!-- error message display -->
              <div id="errorMessageArea">
                <span><i class="fas fa-exclamation-circle text-danger"></i>
                <span id="errorMsg" class="text-danger"> Error Message Here</span></span>
              </div>
              <!-- Modal Body end bellow -->
            </div>
            <div class="modal-footer d-flex justify-content-center pt-1 pb-1">
              <button type="button" class="btn btn-secondary mr-4" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="proceedBtn" disabled>Proceed</button>
            </div>
            <!-- Modal Content end bellow -->
          </div>
          <!-- Modal Dialog end bellow -->
        </div>
        <!-- Modal end bellow -->
      </div>

      <!-- Modal Area end in footer-->
    <!-- </div> -->

<?php include "include/footer.php"; ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script>

showOverlay('--Loading--');

  const filterBtn = document.getElementById('filterButton');
  const filterModal = document.getElementById('filterModal');
  let allData = [];
  let filteredData = [];
  let displayedData = [];
  let currentPage = 1;
  let entriesPerPage = 15;
  let filtersApplied = false;
  let selectedDateRange = {
            start: '',
            end: ''
        };

// Fetch All Audit List From Backend
  document.addEventListener("DOMContentLoaded", function() {
  showOverlay('--Fetching Data--');

    fetch('codes/fetchData/fetch_audit_list_data.php',{
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
        .then(data => {
          allData = data.sort((a, b) => moment(b.date, 'DD-MM-YYYY') - moment(a.date, 'DD-MM-YYYY'));
          filteredData = allData;
          displayedData = allData;
          renderTable('short');
          populateDropdowns(allData);
          // console.log(allData);
        })

    .catch(error => console.error('Error fetching data:', error));

    // Date picker funtionality start
    $('#dateRange').daterangepicker({
        singleDatePicker: false,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            format: 'DD-MM-YYYY',
            cancelLabel: 'Clear',
            applyLabel: 'Ok'
        },
        opens: 'left',
        linkedCalendars: false,
        startDate: moment(),
        endDate: moment()
    }, function(start, end) {
        $('#dateRange').val(start.format('DD-MM-YYYY') + ' - ' + end.format('DD-MM-YYYY'));
        selectedDateRange = {
            start: start.format('YYYY-MM-DD'),
            end: end.format('YYYY-MM-DD')
        };
    });

    function resetDatePicker(picker) {
        $('#dateRange').val('');
        selectedDateRange = {
            start: '',
            end: ''
        };
        picker.setStartDate(moment());
        picker.setEndDate(moment());
        picker.updateView();

        const currentMonth = moment().month();
        const currentYear = moment().year();

        const monthSelect = picker.container.find('.monthselect');
        const yearSelect = picker.container.find('.yearselect');

        monthSelect.val(currentMonth).change();
        yearSelect.val(currentYear).change();

        picker.hide();
    }

    $('#dateRange').on('cancel.daterangepicker', function(ev, picker) {
        resetDatePicker(picker);
    });

    $('#dateRange').on('apply.daterangepicker', function(ev, picker) {
        if ($(this).val() === '') {
            $(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
            selectedDateRange = {
                start: picker.startDate.format('YYYY-MM-DD'),
                end: picker.endDate.format('YYYY-MM-DD')
            };
        }
    });
    // Date picker funtionality End
    // Reset filter form data start
    $('#resetFilterForm').on('click', function() {
        var picker = $('#dateRange').data('daterangepicker');
        resetDatePicker(picker);
        document.getElementById('filterForm').reset();
    });
    // Reset filter form data End

  });
  // Audit List Data fetch End

  // Table shorting funtionality start
    let currentSortColumn = 'formatted_date';
    let currentSortOrder = 'desc'; // Default to descending for date

    // Event listeners for sorting columns
    document.getElementById('header-audit_number').addEventListener('click', () => sortTable('audit_number'));
    document.getElementById('header-bca_id').addEventListener('click', () => sortTable('bca_id'));
    document.getElementById('header-bca_full_name').addEventListener('click', () => sortTable('bca_full_name'));
    document.getElementById('header-bca_bank').addEventListener('click', () => sortTable('bca_bank'));
    document.getElementById('header-mobile_no').addEventListener('click', () => sortTable('mobile_no'));
    document.getElementById('header-state').addEventListener('click', () => sortTable('state'));
    document.getElementById('header-location').addEventListener('click', () => sortTable('location'));
    document.getElementById('header-status').addEventListener('click', () => sortTable('status'));
    document.getElementById('header-formatted_date').addEventListener('click', () => sortTable('formatted_date'));
    document.getElementById('header-created_by').addEventListener('click', () => sortTable('created_by'));

    // Default sorting function
    function defaultSort() {
        displayedData.sort((a, b) => {
            const dateA = new Date(a.formatted_date);
            const dateB = new Date(b.formatted_date);
            
            // Compare by date in descending order (most recent first)
            if (dateA > dateB) return -1;
            if (dateA < dateB) return 1;

            // If dates are the same, compare by audit number (largest to smallest)
            const auditNumberA = parseInt(a.audit_number.replace('AUD', ''), 10);
            const auditNumberB = parseInt(b.audit_number.replace('AUD', ''), 10);
            
            return auditNumberB - auditNumberA;
        });
    }

    // Sort the table based on the clicked column
    function sortTable(column) {
        // Toggle sort order if the same column is clicked
        if (currentSortColumn === column) {
            currentSortOrder = currentSortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            currentSortOrder = 'asc';
        }
        currentSortColumn = column;

        // Sort the data based on the current column and order
        displayedData.sort((a, b) => {
            let valA, valB;
            if (column === 'audit_number') {
                valA = parseInt(a[column].replace('AUD', ''), 10);
                valB = parseInt(b[column].replace('AUD', ''), 10);
            } else if (column === 'formatted_date') {
                valA = new Date(a[column]);
                valB = new Date(b[column]);
            } else {
                valA = a[column];
                valB = b[column];
            }
            if (currentSortOrder === 'asc') {
                return valA > valB ? 1 : -1;
            } else {
                return valA < valB ? 1 : -1;
            }
        });

        // Render the table with sorted data
        renderTable();
        updateTableHeaders();
    }
  // Table shorting funtionality start

    // Render the table
    function renderTable(isDefault) {
        const tbody = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
        tbody.innerHTML = '';

        if (isDefault =='short'){
            defaultSort();
            defaultShortCount = 1;
        }

        const start = (currentPage - 1) * entriesPerPage;
        const end = start + entriesPerPage;
        const paginatedData = displayedData.slice(start, end);

        if (paginatedData.length === 0) {
            const row = document.createElement('tr');
            const cell = document.createElement('td');
            cell.colSpan = 16;
            // Assuming cell is a table cell element
            cell.innerHTML = `<p class="text-lg-center fw-bold pt-3" style="color: red;">No Data Found</p>`;
            row.appendChild(cell);
            tbody.appendChild(row);
        } else {
            paginatedData.forEach((item, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${start + index + 1}</td>
                    <td>${item.audit_number}</td>
                    <td>${item.bca_id}</td>
                    <td>${item.bca_full_name}</td>
                    <td>${item.bca_contact_no}</td>
                    <td>${item.bca_bank}</td>
                    <td>${item.state}</td>
                    <td>${item.location}</td>
                    <td>${item.status}</td>
                    <td>${item.formatted_date}</td>
                    <td>${item.user_full_name}</td>
                    <td>
                    <button type="button" class="action-button" data-audit-number="${item.audit_number}" data-bca-id="${item.bca_id}" data-bca-name="${item.bca_full_name}" data-bca-state="${item.state}" data-bca-location="${item.location}">Open</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }
        updatePaginationControls(displayedData);
        updateRecordInfo(displayedData.length, start, end);
        hideOverlay();
    }

    // Update the table headers to show sorting icons
    function updateTableHeaders() {
        const headers = document.querySelectorAll('.sortable');
        // console.log(headers);

        headers.forEach(header => {
            header.classList.remove('sort-asc', 'sort-desc');
        });

        const currentHeader = document.getElementById(`header-${currentSortColumn}`);
        // console.log(currentHeader);
        if (currentHeader) {
            currentHeader.classList.add(currentSortOrder === 'asc' ? 'sort-asc' : 'sort-desc');
        }
    }

    // Function to add event listeners after the table has been rendered
    function addEventListeners() {
            hideOverlay();
            // on click action button capture row data for storeSessionData
            dataTableBody.addEventListener('click', function(event) {
                if (event.target && event.target.matches('button.action-button')) {
                    const button = event.target;
                    const auditNumber = button.getAttribute('data-audit-number');
                    const bcaId = button.getAttribute('data-bca-id');
                    const bcaName = button.getAttribute('data-bca-name');
                    const state = button.getAttribute('data-bca-state');
                    const location = button.getAttribute('data-bca-location');

                    // Call storeSessionData with the appropriate data
                    storeSessionData(bcaId, bcaName, state, location, auditNumber);
                }
            });
        }

    // Call the function to add event listeners after setting innerHTML
    addEventListeners();
    // Function to fetch BCA name on BCA ID input change
    $('#bcaId').on('input', function() {
      var bcaId = $(this).val().trim();
      if (bcaId.length >= 3) { // Only proceed if BCA ID is 6 characters long
        fetchBcaName(bcaId);
      } else {
        $('#bcaName').val('').prop('disabled', true);
        $('#proceedBtn').prop('disabled', true);
        displayErrorMessage('Please enter a valid 3-digit BCA ID.');
      }
    });

    // Function to fetch BCA name via AJAX
function fetchBcaName(bcaId) {
  $.ajax({
    url: '/bcaudit/codes/fetchData/validate_bca_for_new_audit.php',
    method: 'GET',
    data: { bca_id: bcaId },
    dataType: 'json',
    success: function(response) {
      if (response.success) {
        // console.log(response);
        var bcaName = response.data['bca_name'];
        var state = response.data['state'];
        var location = response.data['location'];
        document.getElementById('errorMessageArea').style.display = 'none';
        $('#bcaName').val(bcaName);
        $('#proceedBtn').prop('disabled', false);

        // Enable proceed button click handler to store session data
        $('#proceedBtn').off('click').on('click', function() {
          storeSessionData(bcaId, bcaName, state, location);
        });
      } else {
        $('#bcaName').val(response.message);
        $('#proceedBtn').prop('disabled', true);
        displayErrorMessage(response.message);
      }
    },
    error: function() {
      $('#bcaName').val('Error fetching name').prop('disabled', true);
      $('#proceedBtn').prop('disabled', true);
      displayErrorMessage('Error fetching BCA name. Please try again.');
    }
  });
}
    // Function to store session data
    function storeSessionData(bcaId, bcaName, state, location, auditNumber) {
      showOverlay();
        if (auditNumber){
            var action = 'newAudit';
        }else{
            var action = 'existingAudit';
        }
      $.ajax({
        url: '/bcaudit/codes/store_session.php',
        type: 'POST',
        data: { bcaId: bcaId, bcaName: bcaName, auditNumber: auditNumber, action: action, state: state, location: location },
        success: function(response) {
          hideOverlay();
          var result = JSON.parse(response);
          if (result.success) {
            // console.log('Session data stored successfully');
            window.location.href = '/bcaudit/progress.php';
          } else {
            console.log('Error: ' + result.message);
            alert('Error: ' + result.message);
          }
        },
        error: function() {
        hideOverlay();
        alert('Error: Unable to send request');
          console.log('AJAX request failed');
        }
      });
    }
    // Function to store session data End

    //  Populate dropdown into filter modal field from fetched data
    function populateDropdowns(data) {
        const stateDropdown = document.getElementById('state');
        // const districtDropdown = document.getElementById('district');
        const locationDropdown = document.getElementById('location');
        const bankDropdown = document.getElementById('bank');
        const createdByDropdown = document.getElementById('createdBy');
        const statusDropdown = document.getElementById('status');

        const states = [...new Set(data.map(item => item.state))];
        // const districts = [...new Set(data.map(item => item.district))];
        const locations = [...new Set(data.map(item => item.location))];
        const banks = [...new Set(data.map(item => item.bca_bank))];
        const users = [...new Set(data.map(item => item.user_full_name))];
        const statuses = [...new Set(data.map(item => item.status))];

        populateDropdown(stateDropdown, states);
        // populateDropdown(districtDropdown, districts);
        populateDropdown(locationDropdown, locations);
        populateDropdown(bankDropdown, banks);
        populateDropdown(createdByDropdown, users);
        populateDropdown(statusDropdown, statuses);
    }

    function populateDropdown(dropdown, options) {
        const selectedValue = dropdown.value;
        dropdown.innerHTML = '<option class="defaultSelect" value="">Select</option>';
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option;
            opt.textContent = option;
            dropdown.appendChild(opt);
        });
        dropdown.value = selectedValue;
    }
    //  Populate dropdown into filter modal field from fetched data End

    // Apply Filter Function
    function applyFilters() {
      const state = document.getElementById('state').value.toLowerCase();
      const location = document.getElementById('location').value.toLowerCase();
      const bank = document.getElementById('bank').value.toLowerCase();
      const createdBy = document.getElementById('createdBy').value.toLowerCase();
      const status = document.getElementById('status').value.toLowerCase();
      
      const dateRange = selectedDateRange || {
          start: moment().format('YYYY-MM-DD'),
          end: moment().format('YYYY-MM-DD')
      };

      // filter count part
      let filterCount = 0;
      if (state !== '') filterCount++;
      if (location !== '') filterCount++;
      if (bank !== '') filterCount++;
      if (createdBy !== '') filterCount++;
      if (status !== '') filterCount++;
      if (dateRange.start !== '') filterCount++;
      // console.log(dateRange.start);
      // date filter part
      filteredData = allData.filter(item => {
          const itemDate = moment(item.created_date, 'DD-MM-YYYY');
          const dateInRange = selectedDateRange ?
              itemDate.isBetween(dateRange.start, dateRange.end, null, '[]') :
              true;

          // filter data asper valid input
          return dateInRange &&
              (state === '' || item.state.toLowerCase().includes(state)) &&
              (location === '' || item.location.toLowerCase().includes(location)) &&
              (bank === '' || item.bca_bank.toLowerCase().includes(bank)) &&
              (createdBy === '' || item.user_full_name.toLowerCase().includes(createdBy)) &&
              (status === '' || item.status.toLowerCase().includes(status));
      });

      // Remove input from search field
      $('#searchInput').val('');

      filtersApplied = true;
      searchTable();

      // Display the filter count
      document.getElementById('filterCount').textContent = filterCount;
  }

    // clearFilters currently Not in use
    function clearFilters() {
        document.getElementById('filter-form').reset();
        selectedDateRange = {
            start: moment().subtract(7, 'days').format('DD-MM-YYYY'),
            end: moment().format('DD-MM-YYYY')
        };
        $('#dateRange').val(`${selectedDateRange.start} - ${selectedDateRange.end}`);

        filteredData = allData;
        filtersApplied = false;
        searchTable();
    }

    $('#exportData').on('click', function() {
      $('#exportData').prop('disabled', true);

  if (filtersApplied) {
    var startDate = selectedDateRange.start || '';
    var endDate = selectedDateRange.end || '';
    var state = $('#state').val();
    var location = $('#location').val();
    var createdBy = $('#createdBy').val();
    var bank = $('#bank').val();
    var status = $('#status').val();
    // console.log(selectedDateRange.start);
    var queryParams = [];

    if (startDate) queryParams.push('start_date=' + encodeURIComponent(startDate));
    if (endDate) queryParams.push('end_date=' + encodeURIComponent(endDate));
    if (state) queryParams.push('state=' + encodeURIComponent(state));
    if (location) queryParams.push('location=' + encodeURIComponent(location));
    if (createdBy) queryParams.push('created_by=' + encodeURIComponent(createdBy));
    if (bank) queryParams.push('bank=' + encodeURIComponent(bank));
    if (status) queryParams.push('status=' + encodeURIComponent(status));

    var queryString = queryParams.length ? '?' + queryParams.join('&') : '';
  } else {
    console.log('Exporting data without filters');
    var queryString = '';
  }
    
    // console.log("export button clicked");

    $.ajax({
        url: '/bcaudit/codes/download_audit_list_csv.php' + queryString,
        type: 'GET',
        dataType: 'json', // Expect JSON response
        success: function(response) {
            if (response.success) {
                // Create an invisible iframe to start the file download
                var iframe = $('<iframe>', {
                    src: response.downloadUrl,
                    style: 'display:none'
                }).appendTo('body');
            } else {
                $('#message').text('Download failed: ' + response.message);
            }
      $('#exportData').prop('disabled', false);
        },
        error: function(xhr, status, error) {
      $('#exportData').prop('disabled', false);
            $('#message').text('An error occurred: ' + xhr.statusText);
            console.error('AJAX request error:', {
                status: status,
                error: error,
                responseText: xhr.responseText
            });
        }
    });
});

    // Search funtionality on rendered table data
    function searchTable() {
        const query = document.getElementById('searchInput').value.toLowerCase();
        const dataToSearch = filtersApplied ? filteredData : allData;

        displayedData = dataToSearch.filter(item => {
            return item.audit_number.toLowerCase().includes(query) ||
                item.bca_id.toLowerCase().includes(query) ||
                item.bca_full_name.toLowerCase().includes(query) ||
                item.bca_contact_no.toLowerCase().includes(query) ||
                item.bca_bank.toLowerCase().includes(query) ||
                item.state.toLowerCase().includes(query) ||
                item.location.toLowerCase().includes(query);
        });

        currentPage = 1;
        renderTable();
    }
    // data showing in table selection funtionality
    function changeEntriesPerPage() {
        entriesPerPage = parseInt(document.getElementById("entriesPerPage").value);
        currentPage = 1;
        renderTable();
    }
    // update pagination depened on redered table data
    function updatePaginationControls(renderedData) {
        const totalEntries = renderedData.length;
        const totalPages = Math.ceil(totalEntries / entriesPerPage);

        if (totalPages < 1) {
            paginationControls.innerHTML = '';
            return;
        }

        let paginationHtml = '';

        if (currentPage > 1) {
            paginationHtml += `<a href="#" class="prev" data-page="${currentPage - 1}">Previous</a>`;
        }

        for (let i = 1; i <= 2; i++) {
            if (i <= totalPages) {
                paginationHtml += `<a href="#" class="${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`;
            }
        }

        if (currentPage > 4) {
            paginationHtml += `<span>...</span>`;
        }

        let startPage = Math.max(3, currentPage - 1);
        let endPage = Math.min(totalPages - 1, currentPage + 1);
        for (let i = startPage; i <= endPage; i++) {
            if (i > 2 && i < totalPages) {
                paginationHtml += `<a href="#" class="${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</a>`;
            }
        }

        if (currentPage < totalPages - 2) {
            paginationHtml += `<span>...</span>`;
        }

        if (totalPages > 2) {
            paginationHtml += `<a href="#" class="${totalPages === currentPage ? 'active' : ''}" data-page="${totalPages}">${totalPages}</a>`;
        }

        if (currentPage < totalPages) {
            paginationHtml += `<a href="#" class="next" data-page="${currentPage + 1}">Next</a>`;
        }

        paginationControls.innerHTML = paginationHtml;

        document.querySelectorAll("#paginationControls a").forEach(a => {
            a.addEventListener("click", function(event) {
                event.preventDefault();
                currentPage = parseInt(this.getAttribute("data-page"));
                renderTable();
            });
        });
    }
    // update pagination depened on redered table data End

    // update data showing information of the rendered table
    function updateRecordInfo(totalEntries, start, end) {
        document.getElementById('recordInfo').innerHTML = `Showing ${Math.min(start + 1, totalEntries)} to ${Math.min(end, totalEntries)} of ${totalEntries} entries`;
    }

  // Open filter modal popup and populate dropdown data
  // filterModal.addEventListener('shown.bs.modal', function(event) {
  //     // console.log('Modal is fully visible');
  //     populateDropdowns(allData);
  // });

    </script>

