<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>General Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.default.css') }}" id="theme-stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
    <style id="dynamic-styles">
        body {
            background-color: #121417;
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom">General Settings</h2>
            </div>
        </div>

        <!-- General Settings Content -->
        <section class="no-padding-bottom">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="block">
                        <div class="block-body">
                            <h4>Site Information</h4>
                            <p>Manage your site’s basic information and branding.</p>
                            <!-- Site Information -->
                            <div class="form-group">
                                <label for="siteName">Site Name</label>
                                <input type="text" class="form-control" id="siteName" placeholder="Enter site name">
                            </div>
                            <div class="form-group">
                                <label for="siteDescription">Site Description</label>
                                <textarea class="form-control" id="siteDescription" rows="3" placeholder="Enter site description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="logoUpload">Upload Logo</label>
                                <input type="file" class="form-control-file" id="logoUpload">
                            </div>
                            <div class="form-group">
                                <label for="faviconUpload">Upload Favicon</label>
                                <input type="file" class="form-control-file" id="faviconUpload">
                            </div>

                            <h4>User Management</h4>
                            <p>Configure user roles, permissions, and settings.</p>
                            <!-- User Management -->
                            <div class="form-group">
                                <label for="userRoles">User Roles</label>
                                <input type="text" class="form-control" id="userRoles" placeholder="Define user roles">
                            </div>
                            <div class="form-group">
                                <label for="defaultUserSettings">Default User Settings</label>
                                <input type="text" class="form-control" id="defaultUserSettings" placeholder="Enter default settings">
                            </div>
                            <div class="form-group">
                                <label for="passwordPolicies">Password Policies</label>
                                <textarea class="form-control" id="passwordPolicies" rows="3" placeholder="Define password policies"></textarea>
                            </div>

                            <h4>Localization</h4>
                            <p>Adjust localization settings for your site.</p>
                            <!-- Localization -->



                            <div class="form-group">
                                <label for="timezoneSelect">Timezone Settings</label>
                                <select class="form-control" id="timezoneSelect">
                                    <option value="UTC">UTC</option>
                                    <option value="America/New_York">America/New York</option>
                                    <option value="Europe/London">Europe/London</option>
                                    <!-- Add more timezones as needed -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dateFormat">Date Format</label>
                                <input type="text" class="form-control" id="dateFormat" placeholder="Enter date format">
                            </div>
                            <div class="form-group">
                                <label for="timeFormat">Time Format</label>
                                <input type="text" class="form-control" id="timeFormat" placeholder="Enter time format">
                            </div>

                            <h4>Theme Selection</h4>
                            <p>Customize the appearance of your site.</p>
                            <!-- Theme Selection -->
                            <div class="form-group">
                                <label for="themeSelect">Select Theme</label>
                                <select class="form-control" id="themeSelect">
                                    <option value="dark">Dark Mode</option>
                                    <option value="light">Light Mode</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primaryColor">Primary Color</label>
                                <input type="color" class="form-control" id="primaryColor" value="#007bff">
                            </div>
                            <div class="form-group">
                                <label for="fontSelect">Select Font</label>
                                <select class="form-control" id="fontSelect">
                                    <option value="Arial">Arial</option>
                                    <option value="Courier New">Courier New</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Verdana">Verdana</option>
                                </select>
                            </div>

                           
                   
                            <button type="button" class="btn btn-primary-custom" data-toggle="modal" data-target="#confirmModal">Save Changes</button>

                            <!-- Save Confirmation Modal -->
                            <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Confirm Changes</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to save these changes?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-primary" id="confirmSave">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Success Alert -->
                            <div class="alert alert-success d-none" id="successAlert">
                                Settings updated successfully!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom JS -->
    <script>
        // Function to apply theme and customization
        function applyCustomizations() {
            const theme = document.getElementById('themeSelect').value;
            const primaryColor = document.getElementById('primaryColor').value;
            const font = document.getElementById('fontSelect').value;
            const dynamicStyles = document.getElementById('dynamic-styles');
            
            let bgColor, textColor;

            if (theme === 'dark') {
                bgColor = '#121417';
                textColor = '#ccc';
            } else {
                bgColor = '#f8f9fa';
                textColor = '#212529';
            }

            dynamicStyles.innerHTML = `
                body {
                    background-color: ${bgColor};
                    color: ${textColor};
                    font-family: ${font};
                }
                .btn-primary-custom {
                    background-color: ${primaryColor};
                    border-color: ${primaryColor};
                }
                .btn-primary-custom:hover {
                    background-color: darken(${primaryColor}, 10%);
                    border-color: darken(${primaryColor}, 15%);
                }
            `;
        }

        // Apply customizations on change
        document.getElementById('themeSelect').addEventListener('change', applyCustomizations);
        document.getElementById('primaryColor').addEventListener('input', applyCustomizations);
        document.getElementById('fontSelect').addEventListener('change', applyCustomizations);

        // Save changes and show success alert
        document.getElementById('confirmSave').addEventListener('click', function() {
            applyCustomizations(); // Apply settings immediately
            $('#confirmModal').modal('hide'); // Hide the modal
            document.getElementById('successAlert').classList.remove('d-none'); // Show success alert
        });

        // Initial customization application
        applyCustomizations();
    </script>

    <div class="text-center mb-3">
        <a href="{{ url('home') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back to Dashboard
        </a>
    </div>
</body>
</html>
