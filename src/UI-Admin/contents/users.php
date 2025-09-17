<div class="d-flex justify-content-between align-items-center mb-2">
    <div class="mx-2">
        <h4>Faculty, Students and QCE management </h4>
    </div>
</div>

<!-- Search and Filters -->

<div class="row g-2  justify-content-evenly">
    <div class="col-md-5">
        <input type="text" id="searchInput" name="search" class="form-control" placeholder="Search...."
            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    </div>
    <div class="col-md-5">
        <select id="categoryFilter" name="category" class="form-select">
            <option value="">All Categories</option>
            <?php
                // Fetch unique categories
                $catStmt = $pdo->query("SELECT DISTINCT user_role FROM user_data ORDER BY created_date ASC");
                while ($cat = $catStmt->fetch(PDO::FETCH_ASSOC)): ?>
            <option value="<?= htmlspecialchars($cat['user_role']) ?>"
                <?= (isset($_GET['category']) && $_GET['category'] === $cat['user_role']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['user_role']) ?>
            </option>
            <?php endwhile; ?>
        </select>

    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#bookFormTemplate"
            id="add_new"><i class="fa fa-plus"></i> New Account</button>
    </div>
</div>

<!-- Users Table -->
<div class="table-responsive ">
    <table class="table table-sm table-bordered align-middle  mb-0 table-hover text-dark " style="font-size: 0.75rem;">
        <thead class="text-center bg-white">
            <tr>
                <th class="py-2 px-2">#</th>
                <th class="py-2 px-2">Name</th>
                <th class="py-2 px-2">Academic ID</th>
                <th class="py-2 px-2">Department</th>
                <th class="py-2 px-2">User Role</th>
                <th class="py-2 px-2">Email</th>
                <th class="py-2 px-2">Gender</th>
                <th class="py-2 px-2">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php

            $sql = "SELECT * FROM user_data
            INNER JOIN department ON user_data.department_id = department.deptID
            ORDER BY lastname ASC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $Users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($Users as $index => $user): ?>
            <tr id="book-<?= $user['user_id'] ?>" class="clickable-row cursor-pointer">
                <td class="py-2 px-2"><?= $index + 1 ?></td>
                <td class="py-2 px-2">
                    <?= htmlspecialchars($user['lastname']) . ", " . htmlspecialchars($user['firstname']) ?></td>
                <td class="py-2 px-2"><?= htmlspecialchars($user['users_academic_id']) ?></td>
                <td class="py-2 px-2"><?= htmlspecialchars($user['department_name']) ?></td>
                <td class="py-2 px-2"><?= htmlspecialchars($user['user_role']) ?></td>
                <td class="py-2 px-2"><?= htmlspecialchars($user['email']) ?></td>
                <td class="py-2 px-2"><?= htmlspecialchars($user['gender']) ?></td>
                <td class="py-2 px-2">
                    <button class="m-0 btn btn-sm btn-dark py-1 px-2" id="viewUserProfile"><a href="index.php?page=contents/profile&user_id=<?= $user["user_id"] ?>" class="w-100 h-100" style="color: #fff !important;">view</a></button>
                    <button class="m-0 btn btn-sm btn-danger py-1 px-2" data-bs-toggle="modal"
                        data-bs-target="#deleteUserModal" data-user-id="<?= $user['user_id'] ?>"
                        data-user-name="<?= htmlspecialchars($user['lastname'] . ', ' . $user['firstname']) ?>">
                        Delete
                    </button>

                </td>

            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Add Users Modal -->
<div class="modal fade" id="bookFormTemplate" aria-modal="true" role="dialog" tabindex="-1"
    aria-labelledby="bookFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl ">
        <div class="modal-content modal-dialog-scrollable">
            <div class="modal-header Primary-color">
                <h5 class="modal-title text-white" id="bookFormLabel">Create New Accounts</h5>
                <button type="button" class="btn-close" id="closeBtn" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <!-- ✅ Form wraps modal-body and modal-footer -->
            <main class="login-page d-flex justify-content-center align-items-center">
                <div class="container p-0 m-0 w-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="row justify-content-center w-100">
                        <div class="w-100">
                            <!-- <div class="card-header shadow getLeft "> -->

                            <div class="card-body w-100">
                                <form class="row g-1" action="../../authentication/auth.php" method="post"
                                    class="w-100">
                                    <input required type="hidden" name="createUsers" value="true">
                                    <div class="col-md-12 col-12 ">
                                        <h5 class="mt-3 mb-1">Personal Information</h5>
                                    </div>
                                    <!-- Account Type -->
                                    <div class="col-md-3">
                                        <label class="form-label">Last Name</label>
                                        <input required type="text" class="form-control" name="lastName">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">First Name</label>
                                        <input required type="text" class="form-control" name="firstName">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Middle Name</label>
                                        <input required type="text" class="form-control" name="middleName">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Suffix</label>
                                        <select class="form-select" name="suffix">
                                            <option value="" disabled selected>Select suffix (optional) </option>
                                            <option value="Jr">Jr</option>
                                            <option value="Sr">Sr</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Account Type</label>
                                        <select class="form-select" name="user_role">
                                            <option value="" disabled selected>Select account type</option>
                                            <option value="QCE">QCE</option>
                                            <option value="SUPERVISOR">Supervisor</option>
                                            <option value="FACULTY">Faculty</option>
                                            <option value="STUDENT">Student</option>
                                        </select>

                                    </div>
                                    <div class="col-md-4 col-4 mt-2">
                                        <span>Departments</span>
                                        <?php 
                                            $query = "SELECT * FROM department;";
                                            $stmt = $pdo->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <select name="department_ID" id="" class="form-select">
                                            <option value="" disable>Select Department</option>
                                            <?php foreach($result as $row) : ?>
                                            <option value="<?= $row["deptID"] ?>"><?= $row["department_name"] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- Contact Information -->
                                    <div class="col-md-4">
                                        <label class="form-label">Academic Rank</label>
                                        <input required type="text" class="form-control" name="academicRank">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Teacher ID</label>
                                        <input required type="text" class="form-control" name="teacherID">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Email</label>
                                        <input required type="email" class="form-control" name="email">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Sex</label>
                                        <select class="form-select" name="gender">
                                            <option value="" disabled selected>Select sex</option>
                                            <option value="MALE">MALE</option>
                                            <option value="FEMALE">FEMALE</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 ">
                                        <h5 class="mt-3 mb-1">Account Authentication</h5>
                                    </div>
                                    <!-- Account Info -->
                                    <div class="col-md-4">
                                        <label class="form-label">Username</label>
                                        <input required type="text" class="form-control" name="username">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Password</label>
                                        <input required type="password" class="form-control" name="password">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Confirm Password</label>
                                        <input required type="password" class="form-control" name="cpassword">
                                    </div>

                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn btn-dark px-5">
                                            <i class="bi bi-person-plus-fill me-1"></i> Create Account
                                        </button>
                                    </div>

                                </form>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header Primary-color text-white">
                <h5 class="modal-title text-white" id="deleteUserModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong><span id="deleteUserName"></span></strong>?
            </div>
            <div class="modal-footer">
                <form action="../../authentication/auth.php" method="POST">
                    <input type="hidden" name="deleteUser" value="true">
                    <input type="hidden" name="delete_user_id" id="deleteUserID">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- CATEGORY SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const categoryFilter = document.getElementById("categoryFilter");
    const tableBody = document.querySelector("table tbody");

    function filterTable() {
        const searchValue = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value.toLowerCase();

        const rows = tableBody.querySelectorAll("tr");

        rows.forEach(row => {
            const name = row.children[1].textContent.toLowerCase();        // Name column
            const role = row.children[4].textContent.toLowerCase();        // User Role column

            const matchesSearch = name.includes(searchValue);
            const matchesCategory = selectedCategory === "" || role === selectedCategory;

            if (matchesSearch && matchesCategory) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    // Attach event listeners
    searchInput.addEventListener("input", filterTable);
    categoryFilter.addEventListener("change", filterTable);

    // Optional: apply filters on load if needed
    filterTable();
});
</script>
<!-- DELETE USER SCRIP -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteUserModal = document.getElementById('deleteUserModal');
        deleteUserModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userID = button.getAttribute('data-user-id');
            var userName = button.getAttribute('data-user-name');

            document.getElementById('deleteUserID').value = userID;
            document.getElementById('deleteUserName').textContent = userName;
        });
    });
</script>
<!-- TOAST NOTIFICATION -->
<?php if ( 
    isset($_GET['teacherID']) || 
    isset($_GET['create']) || 
    isset($_GET['username']) || 
    isset($_GET['email']) || 
    isset($_GET['deleteUser']) ||
    isset($_GET['password'])
): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const messages = {
        teacherID: {
            icon: 'error',
            title: 'Teacher ID already Exist!'
        },
        create: {
            icon: 'success',
            title: 'Account Created successfully!'
        },
        username: {
            icon: 'error',
            title: 'Username Already Exist!'
        },
        email: {
            icon: 'error',
            title: 'email Already Exist!'
        },
        deleteUser: {
            icon: 'success',
            title: 'User Deleted Successfully!'
        },
        password: {
            icon: 'error',
            title: 'Password not match!'
        }
    };

    for (const key in messages) {
        const value = new URLSearchParams(window.location.search).get(key);
        if (value) {
            Swal.fire({
                toast: true,
                icon: messages[key].icon,
                title: messages[key].title,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didClose: () => removeUrlParams([key])
            });
            break;
        }
    }

    function removeUrlParams(params) {
        const url = new URL(window.location);
        params.forEach(param => url.searchParams.delete(param));
        window.history.replaceState({}, document.title, url.toString());
    }
});
</script>
<?php endif; ?>