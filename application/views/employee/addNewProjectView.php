<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Project | Supropriyo Enterprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* [Previous CSS remains exactly the same - keeping it brief] */
        :root {
            --primary-gradient: radial-gradient(circle at 0% 50%, #461bb9 20%, #973ce0 50%, #6b37e4 100%);
            --primary: #461bb9;
            --secondary: #973ce0;
            --accent: #6b37e4;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(255, 255, 255, 0.25);
            --shadow-light: 0 10px 40px rgba(0, 0, 0, 0.15);
            --shadow-hover: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--primary-gradient);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.97);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            padding: 25px 20px;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }

        .logo {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid rgba(70, 27, 185, 0.1);
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #461bb9, #973ce0);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 15px;
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .logo h5 {
            color: #461bb9;
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: #6b37e4 !important;
            font-weight: 500;
            margin-bottom: 12px;
            padding: 12px 20px !important;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .nav-link i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .nav-link:hover {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white !important;
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .nav-link.active {
            background: linear-gradient(135deg, #461bb9, #973ce0);
            color: white !important;
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
            min-height: 100vh;
            background: #0f0f23;
        }

        .welcome {
            text-align: center;
            color: white;
            margin-bottom: 40px;
        }

        .welcome h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #fff, rgba(255, 255, 255, 0.8));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
        }

        .project-container {
            max-width: 1000px;
            margin: 0 auto 30px;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-light);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 2.5rem 3rem;
            text-align: center;
        }

        .form-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .form-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .form-body {
            padding: 3rem;
        }

        /* Project ID Section INSIDE FORM */
        .project-id-section {
            background: rgba(255, 255, 255, 0.98);
            padding: 1.5rem 3rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .project-id-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex: 1;
            min-width: 300px;
        }

        .project-id-input {
            flex: 1;
            height: 44px;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }

        .project-id-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(70, 27, 185, 0.1);
            outline: none;
        }

        .fetch-btn {
            height: 44px;
            padding: 0 1.5rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .fetch-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .required {
            color: #ef4444;
        }

        .form-control,
        .form-select {
            height: 48px;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(70, 27, 185, 0.1);
            transform: translateY(-1px);
        }

        .form-control-textarea {
            min-height: 80px;
            resize: vertical;
            padding: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2.5rem;
            padding-top: 2rem;
            margin-bottom: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            min-width: 160px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            box-shadow: 0 8px 25px rgba(70, 27, 185, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(70, 27, 185, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #6b7280;
            border: 2px solid #e5e7eb;
        }

        .btn-secondary:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .form-body {
                padding: 2rem 1.5rem;
            }

            .project-id-section {
                flex-direction: column;
                padding: 1.5rem 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        /*  Utility class to hide elements when needed */
        .d-none {
            display: none !important;
        }
    </style>
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

            <!-- ✅ FORM TAG STARTS HERE - WRAPS EVERYTHING -->
            <form id="projectForm" method="post" action="<?= base_url('index.php/Employee/addProject') ?>">

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
                        <!-- <div class="form-group">
                            <label class="form-label">Head Employee ID <span class="required">*</span></label>
                            <input type="text" class="form-control" id="headEmpId" name="headEmpId"
                                placeholder="Enter Head Employee ID" required>
                        </div> -->
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
                    <button type="submit" id="addBtn" formaction="<?= base_url('index.php/Employee/addProject') ?>"
                        class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Project
                    </button>

                    <button type="submit" id="updateBtn"
                        formaction="<?= base_url('index.php/Employee/updateProject') ?>" class="btn btn-success d-none">
                        <i class="fas fa-edit me-2"></i>Update Project
                    </button>

                    <button type="button" class="btn btn-secondary" onclick="resetForm()">
                        <i class="fas fa-undo me-2"></i>Reset
                    </button>
                </div>
            </form> <!-- ✅ FORM TAG ENDS HERE -->
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

            fetch("<?= base_url('index.php/Employee/fetchProject') ?>", {
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