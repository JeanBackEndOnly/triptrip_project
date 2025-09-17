<div class="d-flex justify-content-between align-items-center mb-2">
    <div class="mx-2">
        <h4>Department and Course management </h4>
    </div>
</div>
<!-- Search and Filters -->
<form method="get" class="mb-3">
    <div class="row g-2  justify-content-evenly">
        <div class="col-md-8">
            <select id="categoryFilter" name="category" onclick="category()" class="form-select">
                <option value="">All Categories</option>
                <option value="Department">Department</option>
                <option value="Course">Course</option>
            </select>

        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#Course" id="add_new"><i class="fa fa-plus"></i> Course</button>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#bookFormTemplate" id="add_new"><i class="fa fa-plus"></i> Departments</button>
        </div>
    </div>
</form>

<!-- DEPARTMENTS TABLE -->
<div class="table-responsive " id="departmentTable">
    <table  class="table table-sm table-bordered align-middle  mb-0 table-hover text-dark " style="font-size: 0.75rem;">
        <thead class="text-center bg-white">
            <tr>
                <th class="py-2 px-2">#</th>
                <th class="py-2 px-2">Department Name</th>
                <th class="py-2 px-2">Code</th>
                <th class="py-2 px-2">Added At</th>
                <th class="py-2 px-2">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php

            $sql = "SELECT * FROM department ORDER BY department_name ASC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $Users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($Users as $index => $user): ?>
                <tr id="book-<?= $user['deptID'] ?>" class="clickable-row cursor-pointer">
                    <td class="py-2 px-2"><?= $index + 1 ?></td>
                    <td class="py-2 px-2"><?= htmlspecialchars($user['department_name']) ?></td>
                    <td class="py-2 px-2"><?= htmlspecialchars($user['Code']) ?></td>
                    <td class="py-2 px-2"><?= htmlspecialchars($user['added_at']) ?></td>
                    <td class="py-2 px-2">
                        <button class="m-0 btn btn-sm btn-dark py-1 px-2 btn-edit">Edit</button>
                        <button class="m-0 btn btn-sm btn-danger py-1 px-2 btn-delete">Delete</button>
                    </td>
                       
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- COURSE TABLE -->
<div class="table-responsive " style="display: none;">
    <table  class="table table-sm table-bordered align-middle  mb-0 table-hover text-dark " style="font-size: 0.75rem;">
        <thead class="text-center bg-white">
            <tr>
                <th class="py-2 px-2">#</th>
                <th class="py-2 px-2">Course Name</th>
                <th class="py-2 px-2">Course Code</th>
                <th class="py-2 px-2">Added At</th>
                <th class="py-2 px-2">Action</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php

            $sql = "SELECT * FROM Course ORDER BY course_name ASC";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $Users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($Users as $index => $user): ?>
                <tr id="book-<?= $user['courseID'] ?>" class="clickable-row cursor-pointer">
                    <td class="py-2 px-2"><?= $index + 1 ?></td>
                    <td class="py-2 px-2"><?= htmlspecialchars($user['course_name']) ?></td>
                    <td class="py-2 px-2"><?= htmlspecialchars($user['course_code']) ?></td>
                    <td class="py-2 px-2"><?= htmlspecialchars($user['added_at']) ?></td>
                    <td class="py-2 px-2">
                        <button class="m-0 btn btn-sm btn-dark py-1 px-2 btn-editCourse">Edit</button>
                        <button class="m-0 btn btn-sm btn-danger py-1 px-2 btn-deleteCourse">Delete</button>
                    </td>
                       
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- ADD DEPARTMENTS -->
<div class="modal fade" id="bookFormTemplate" aria-modal="true" role="dialog" tabindex="-1" aria-labelledby="bookFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-dialog-scrollable">
            <div class="modal-header Primary-color">
                <h5 class="modal-title text-white" id="bookFormLabel">Add new Department</h5>
                <button type="button" class="btn-close" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- ✅ Form wraps modal-body and modal-footer -->
            <main class="login-page d-flex justify-content-center align-items-center">
                <div class="container p-0 m-0 w-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="row justify-content-center w-100">
                        <div class="w-100">
                            <!-- <div class="card-header shadow getLeft "> -->

                            <div class="card-body w-100">
                                <form class="row g-1" action="../../authentication/auth.php" method="post" class="w-100">
                                    <input required type="hidden" name="addDepartments" value="true">
                                    <!-- Account Type -->
                                     <div class="col-md-12 col-12 d-flex flex-column my-2 p-0">
                                        <span>Department name</span>
                                        <input required type="text" name="department_name" class="form-control" placeholder="ex. College of Computing and Sciences">
                                     </div>
                                     <div class="col-md-12 col-12 d-flex flex-column my-2 p-0">
                                        <span>Department code</span>
                                        <input required type="text" name="Code" class="form-control" placeholder="ex. CICS">
                                     </div>

                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn btn-dark px-5">
                                            <i class="bi bi-person-plus-fill me-1"></i> Submit
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
<!-- ADD COURSE -->
 <div class="modal fade" id="Course" aria-modal="true" role="dialog" tabindex="-1" aria-labelledby="bookFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content modal-dialog-scrollable">
            <div class="modal-header Primary-color">
                <h5 class="modal-title text-white" id="bookFormLabel">Add new Department</h5>
                <button type="button" class="btn-close" id="closeBtn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- ✅ Form wraps modal-body and modal-footer -->
            <main class="login-page d-flex justify-content-center align-items-center">
                <div class="container p-0 m-0 w-100 d-flex flex-column justify-content-center align-items-center">
                    <div class="row justify-content-center w-100">
                        <div class="w-100">
                            <!-- <div class="card-header shadow getLeft "> -->

                            <div class="card-body w-100">
                                <form class="row g-1" action="../../authentication/auth.php" method="post" class="w-100">
                                    <input required type="hidden" name="addCourse" value="true">
                                    <!-- Account Type -->
                                     <div class="col-md-12 col-12 d-flex flex-column my-2 p-0">
                                        <span>Course name</span>
                                        <input required type="text" name="course_name" class="form-control" placeholder="ex. Bachelore of Science in Information Technology">
                                     </div>
                                     <div class="col-md-12 col-12 d-flex flex-column my-2 p-0">
                                        <span>Course Code</span>
                                        <input required type="text" name="course_code" class="form-control" placeholder="ex. BSIT">
                                     </div>
                                     <div class="col-md-12 col-12 d-flex flex-column my-2 p-0">
                                        <span>Under Department</span>
                                        <?php 
                                            $query = "SELECT * FROM department;";
                                            $stmt = $pdo->prepare($query);
                                            $stmt->execute();
                                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        ?>
                                        <select required name="department_ID" id="" class="form-select">
                                            <option value="" disable >Select Department</option>
                                            <?php foreach($result as $row) : ?>
                                                <option value="<?= $row["deptID"] ?>"><?= $row["department_name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>    
                                    </div>

                                    <div class="col-12 text-center mt-3">
                                        <button type="submit" class="btn btn-dark px-5">
                                            <i class="bi bi-person-plus-fill me-1"></i> Submit
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
<!-- EDIT MODAL DEPARTMENT -->
 <div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" action="../../authentication/auth.php">
        <input type="hidden" name="editDepartment" value="true">
      <div class="modal-content">
        <div class="modal-header Primary-color text-white">
          <h5 class="modal-title text-white">Edit Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="deptID" id="editDeptID">
          <div class="mb-3">
            <label for="editDepartmentName" class="form-label">Department Name</label>
            <input type="text" name="department_name" id="editDepartmentName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="editDepartmentCode" class="form-label">Department Code</label>
            <input type="text" name="department_code" id="editDepartmentCode" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-dark">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- DELETE MODAL DEPARTMENT -->
 <div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" action="../../authentication/auth.php">
        <input type="hidden" name="deleteDepartment" value="true">
      <div class="modal-content">
        <div class="modal-header Primary-color text-white">
          <h5 class="modal-title text-white">Delete Department</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="deptID" id="deleteDeptID">
          <p class="text-black" style="color: #000 !important;">Are you sure you want to delete this department?</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-dark">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- EDIT MODAL COURSE -->
 <div class="modal fade" id="editModalCouse" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" action="../../authentication/auth.php">
        <input type="hidden" name="editCourse" value="true">
      <div class="modal-content">
        <div class="modal-header Primary-color text-white">
          <h5 class="modal-title text-white">Edit Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="courseID" id="editCourseID">
          <div class="mb-3">
            <label for="editCourseName" class="form-label">Course Name</label>
            <input type="text" name="course_name" id="editCourseName" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="editCourseCode" class="form-label">Course Code</label>
            <input type="text" name="course_code" id="editCourseCode" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-dark">Save Changes</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- DELETE MODAL COURSE -->
 <div class="modal fade" id="deleteModalCourses" tabindex="-1">
  <div class="modal-dialog">
    <form method="post" action="../../authentication/auth.php">
        <input type="hidden" name="deleteCourse" value="true">
      <div class="modal-content">
        <div class="modal-header Primary-color text-white">
          <h5 class="modal-title text-white">Delete Course</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="courseID" id="deleteCourseID">
          <p class="text-black" style="color: #000 !important;">Are you sure you want to delete this Course?</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-dark">Delete</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- JAVA SCRIPTS -->

<!-- EDIT DELETE DEPARTMENT -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // EDIT
        document.querySelectorAll(".btn-edit").forEach(btn => {
            btn.addEventListener("click", function () {
                const row = this.closest("tr");
                const id = row.id.split("-")[1];
                const name = row.querySelectorAll("td")[1].innerText;
                const code = row.querySelectorAll("td")[2].innerText;

                document.getElementById("editDeptID").value = id;
                document.getElementById("editDepartmentName").value = name;
                document.getElementById("editDepartmentCode").value = code;
                
                new bootstrap.Modal(document.getElementById("editModal")).show();
            });
        });

        // DELETE
        document.querySelectorAll(".btn-delete").forEach(btn => {
            btn.addEventListener("click", function () {
                const row = this.closest("tr");
                const id = row.id.split("-")[1];

                document.getElementById("deleteDeptID").value = id;
                new bootstrap.Modal(document.getElementById("deleteModal")).show();
            });
        });
    });
</script>
<!-- EDIT DELETE COURSE -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // EDIT
        document.querySelectorAll(".btn-editCourse").forEach(btn => {
            btn.addEventListener("click", function () {
                const row = this.closest("tr");
                const id = row.id.split("-")[1];
                const name = row.querySelectorAll("td")[1].innerText;
                const code = row.querySelectorAll("td")[2].innerText;

                document.getElementById("editCourseID").value = id;
                document.getElementById("editCourseName").value = name;
                document.getElementById("editCourseCode").value = code;
                
                new bootstrap.Modal(document.getElementById("editModalCouse")).show();
            });
        });

        // DELETE
        document.querySelectorAll(".btn-deleteCourse").forEach(btn => {
            btn.addEventListener("click", function () {
                const row = this.closest("tr");
                const id = row.id.split("-")[1];

                document.getElementById("deleteCourseID").value = id;
                new bootstrap.Modal(document.getElementById("deleteModalCourses")).show();
            });
        });
    });
</script>
<!-- CATEGORIES -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryFilter = document.getElementById('categoryFilter');
        const departmentTable = document.getElementById('departmentTable');
        const courseTable = document.querySelector('.table-responsive[style*="display: none"]');

        // Trigger change immediately on page load
        toggleTable(categoryFilter.value);

        categoryFilter.addEventListener('change', function () {
            toggleTable(this.value);
        });

        function toggleTable(value) {
            if (value === "Department") {
                departmentTable.style.display = "block";
                courseTable.style.display = "none";
            } else if (value === "Course") {
                departmentTable.style.display = "none";
                courseTable.style.display = "block";
            }
        }
    });
</script>
<!-- TOAST NOTIFICATIONS -->
<?php if ( 
    isset($_GET['update']) || 
    isset($_GET['name']) || 
    isset($_GET['departmentsEdit']) || 
    isset($_GET['courseEdit']) || 
    isset($_GET['courseDelete']) || 
    isset($_GET['departmentsDelete']) 
): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const messages = {
            update: { icon: 'success', title: 'Department added successfully!' },
            name: { icon: 'error', title: 'Department name already Exist!' },
            departmentsEdit: { icon: 'success', title: 'Department Edited successfully!' },
            courseEdit: { icon: 'success', title: 'Course Edited successfully!' },
            courseDelete: { icon: 'success', title: 'Course Deleted successfully!' },
            departmentsDelete: { icon: 'success', title: 'Department Deleted successfully!' }
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
    function category() {
        alert('department trigger');
    const categoryFilter = document.getElementById("categoryFilter").value;
    const departmentTable = document.getElementById("departmentTable");
    const courseTable = document.getElementById("courseTable");
        if(categoryFilter.value === 'Department'){
            alert('department trigger');
            departmentTable.style.display = 'flex';
            courseTable.style.display = 'none';
        }else if(categoryFilter.value === 'Course'){
            alert('Course trigger');
            departmentTable.style.display = 'none';
            courseTable.style.display = 'flex';
        }
    }
</script>
<?php endif; ?>