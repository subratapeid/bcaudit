<?php
$pageTitle = "All Users List";
include "include/navbar.php";
?>

<style>
    .card {
        max-width: 520px;
        margin: 80px auto;
    }
</style>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Add New BC</h5>
        </div>

        <div class="card-body">
            <form id="bcForm" autocomplete="off">

                <div class="mb-3">
                    <label class="form-label">BCA ID</label>
                    <input type="text" name="bca_id" class="form-control" placeholder="Enter BCA ID" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="bca_full_name" class="form-control" placeholder="Enter Full Name" required>
                </div>

                <button type="submit" class="btn btn-danger w-100">
                    Save BC
                </button>

            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('bcForm');
        const submitBtn = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            submitBtn.disabled = true;
            submitBtn.textContent = 'Saving...';

            const formData = new FormData(form);

            fetch('/bcaudit/codes/insert_new_bc.php', {
                method: 'POST',
                body: formData
            })
                .then(res => res.json())
                .then(result => {

                    if (result.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message,
                            timer: 3000,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                        });

                        form.reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message,
                            showConfirmButton: true,
                            confirmButtonText: 'OK',
                        });
                    }

                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.'
                    });
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Save BC';
                });
        });

    });
</script>

<?php include "include/footer.php"; ?>