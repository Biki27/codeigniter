<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Project | Supropriyo Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url() ?>css/admin/addNewProjectView.css">
</head>
<body>
    <?php if ($this->session->flashdata('msg')) { ?>

        <script>
            alert("<?= $this->session->flashdata('msg') ?>");
        </script>
    <?php } ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="welcome">
            <h1>Add New Project</h1>
            <p>Project Management Dashboard</p>
        </div>

        <div class="project-container">
            <!-- Header -->
            <div class="form-header">
                <h1 class="form-title">
                    <i class="fas fa-project-diagram me-3"></i>
                    New Project Details
                </h1>
                <p class="form-subtitle">Complete project information for enterprise tracking</p>
            </div>

            <!-- FORM TAG STARTS HERE - WRAPS EVERYTHING -->
            <form id="projectForm" method="post" action="<?= base_url('Employee/addProject') ?>">

                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">

                <!-- Form Body -->
                <div class="form-body">
                    <!-- Project ID Fetch Section - NOW INSIDE FORM -->
                    <div class="project-id-section">
                        <div class="project-id-group">
                            <label
                                style="font-weight: 600; color: #374151; font-size: 0.9rem; white-space: nowrap;">Project
                                ID:</label>
                            <input type="text" class="project-id-input" id="projectId" name="projectId"
                                placeholder="Enter Project ID">
                        </div>
                        <button type="button" class="fetch-btn" onclick="fetchProject()">
                            <i class="fas fa-search me-1"></i>Fetch
                        </button>
                    </div>

                    <!-- Form Grid -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Project Name <span class="required">*</span></label>
                            <input type="text" class="form-control" id="projectName" name="projectName"
                                placeholder="Project Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description <span class="required">*</span></label>
                            <textarea class="form-control form-control-textarea" id="description" name="description"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Start Date <span class="required">*</span></label>
                            <input type="date" class="form-control" id="startDate" name="startDate" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deadline Date <span class="required">*</span></label>
                            <input type="date" class="form-control" id="deadlineDate" name="deadlineDate" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Client Name <span class="required">*</span></label>
                            <input type="text" class="form-control" id="clientName" name="clientName"
                                placeholder="Enter Client Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Head of Project <span class="required">*</span></label>
                            <input type="text" class="form-control" id="projectHead" name="projectHead"
                                placeholder="Enter Project Head Name" required>
                        </div>
                      
                        <div class="form-group">
                            <label class="form-label">Price (₹) <span class="required">*</span></label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="12.5L"
                                required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status <span class="required">*</span></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="running">Running</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons - NOW INSIDE FORM -->
                <div class="action-buttons">
                    <button type="submit" id="addBtn" formaction="<?= base_url('Employee/addProject') ?>"
                        class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Project
                    </button>

                    <button type="submit" id="updateBtn"
                        formaction="<?= base_url('Employee/updateProject') ?>" class="btn btn-success d-none">
                        <i class="fas fa-edit me-2"></i>Update Project
                    </button>

                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <i class="fas fa-undo me-2"></i>Reset
                    </button>
                </div>
            </form> <!--FORM TAG ENDS HERE -->
        </div>
    </div>

    <script>
        // Set default dates
        document.getElementById('startDate').valueAsDate = new Date();
        document.getElementById('deadlineDate').valueAsDate = new Date(new Date().setMonth(new Date().getMonth() + 1));

        function resetForm() {
            document.getElementById('projectForm').reset();
            document.getElementById('projectId').value = '';
            document.getElementById('startDate').valueAsDate = new Date();
            document.getElementById('deadlineDate').valueAsDate = new Date(new Date().setMonth(new Date().getMonth() + 1));

            // Show Add button and hide Update button
            document.getElementById("addBtn").classList.remove("d-none");
            document.getElementById("updateBtn").classList.add("d-none");
        }

        function fetchProject() {

            let projectId = document.getElementById("projectId").value;

            if (!projectId) {
                alert("Please enter Project ID");
                return;
            }

            // Remove PJ prefix
            projectId = projectId.replace(/[^0-9]/g, "");
            const csrfName = "<?= $this->security->get_csrf_token_name(); ?>";
            const csrfHash = "<?= $this->security->get_csrf_hash(); ?>";

            fetch("<?= base_url('Employee/fetchProject') ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: "id=" + projectId + "&" + csrfName + "=" + csrfHash
            }).then(response => response.json())
                .then(data => {

                    if (!data) {
                        alert("Project not found");
                        return;
                    }

                    document.getElementById("projectName").value = data.seproj_name;
                    document.getElementById("description").value = data.seproj_desc;
                    document.getElementById("startDate").value = data.seproj_date;
                    document.getElementById("deadlineDate").value = data.seproj_deadline;
                    document.getElementById("clientName").value = data.seproj_clientid;
                    document.getElementById("projectHead").value = data.seproj_headid;
                    document.getElementById("price").value = data.seproj_price;
                    document.getElementById("status").value = data.seproj_status;

                });
                // Show Update button and hide Add button
                document.getElementById("addBtn").classList.add("d-none");
                document.getElementById("updateBtn").classList.remove("d-none");
        }

        function addProject(event) {
            event.preventDefault(); // Prevent form submission
            const formData = new FormData(document.getElementById('projectForm'));
            const data = Object.fromEntries(formData);

            if (!data.projectName || !data.status) {
                alert('⚠️ Please fill all required fields');
                return;
            }

            alert('✅ Project Added Successfully!\n\n' + JSON.stringify(data, null, 2));
            resetForm();
        }

        
        function logout() {
            if (confirm('Logout from Admin Dashboard?')) {
                window.location.href = 'login.html';
            }
        }
    </script>
</body>

</html>