<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View - School Enrollment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .school-bg {
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                        url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0L100 50L50 100L0 50L50 0z' fill='%230d6efd' fill-opacity='0.1'/%3E%3C/svg%3E");
        }
        .admin-card {
            max-width: 90%; /* Takes up 90% of the container width */
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #003366; /* Deep blue color matching the view button */
            color: white;
        }
        .form-section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 1px solid #dee2e6;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-label {
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 14px;
        }
        .form-control-static {
            background-color: #f8f9fa;
            padding: 6px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            min-height: 38px;
            font-size: 14px;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .btn-decline {
            background-color: #8B0000;
            color: white;
            border: none;
            width: 120px;
        }
        .btn-approve {
            background-color: #0096FF;
            color: white;
            border: none;
            width: 120px;
        }
        .btn-view {
            background-color: #003366;
            color: white;
            width: 100px;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
        }
        .school-logo {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body class="school-bg">
    <div class="container">
        <div class="admin-card card">
            <div class="card-header header-container">
                <h4 class="mb-0 text-white">St. John the Baptist Parochial School Admission Form</h4>
                <img src="logo.jpg" alt="School Logo" class="school-logo rounded-circle">
            </div>
            <div class="card-body">
                <!-- General Information Section -->
                <div class="form-section">
                    <h5 class="section-title">General Information</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Last Name *</label>
                                <div class="form-control-static" id="displayLastName"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">First Name *</label>
                                <div class="form-control-static" id="displayFirstName"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Middle Name *</label>
                                <div class="form-control-static" id="displayMiddleName">N/A if none</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Suffix</label>
                                <div class="form-control-static" id="displaySuffix">N/A</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Province *</label>
                                <div class="form-control-static" id="displayProvince"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Municipality *</label>
                                <div class="form-control-static" id="displayMunicipality"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Barangay *</label>
                                <div class="form-control-static" id="displayBarangay"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">House Number, Street, Subdivision *</label>
                                <div class="form-control-static" id="displayStreetAddress"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">ZIP Code *</label>
                                <div class="form-control-static" id="displayZipCode"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Date of Birth *</label>
                                <div class="form-control-static" id="displayDateOfBirth"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Place of Birth *</label>
                                <div class="form-control-static" id="displayPlaceOfBirth"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Gender *</label>
                                <div class="form-control-static" id="displayGender"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Nationality *</label>
                                <div class="form-control-static" id="displayNationality"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Religion *</label>
                                <div class="form-control-static" id="displayReligion"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Previous Grade Level *</label>
                                <div class="form-control-static" id="displayGradeLevel"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <div class="form-control-static" id="displayEmail"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label">Contact Number *</label>
                                <div class="form-control-static" id="displayContactNumber"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">School Last Attended *</label>
                                <div class="form-control-static" id="displaySchoolLastAttended"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Family Background Section -->
                <div class="form-section">
                    <h5 class="section-title">Family Background</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Father's Full Name *</label>
                                <div class="form-control-static" id="displayFatherFullName"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Father's Occupation</label>
                                <div class="form-control-static" id="displayFatherOccupation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Father's Contact Number *</label>
                                <div class="form-control-static" id="displayFatherContactNumber"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Mother's Full Name *</label>
                                <div class="form-control-static" id="displayMotherFullName"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Mother's Occupation</label>
                                <div class="form-control-static" id="displayMotherOccupation"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Mother's Contact Number *</label>
                                <div class="form-control-static" id="displayMotherContactNumber"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Guardian's Full Name *</label>
                                <div class="form-control-static" id="displayGuardianFullName"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Relationship to Student *</label>
                                <div class="form-control-static" id="displayRelationshipToStudent"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Guardian's Contact Number *</label>
                                <div class="form-control-static" id="displayGuardianContactNumber"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Requirements Section -->
                <div class="form-section">
                    <h5 class="section-title">Requirements</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">School Year *</label>
                                <div class="form-control-static" id="displaySchoolYear"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Type of Student *</label>
                                <div class="form-control-static" id="displayStudentType"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Applying For *</label>
                                <div class="form-control-static" id="displayApplyingFor"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Birth Certificate *</label>
                                <button class="btn btn-view">View</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Report Card *</label>
                                <button class="btn btn-view">View</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">2x2 Picture *</label>
                                <button class="btn btn-view">View</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="button" class="btn btn-decline" id="declineBtn">Decline</button>
                    <button type="button" class="btn btn-approve" id="approveBtn">Approve</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Decline Reason Modal -->
    <div class="modal fade" id="declineModal" tabindex="-1" aria-labelledby="declineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="declineModalLabel">Reason for Declining</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="declineForm">
                        <div class="mb-3">
                            <label for="declineReason" class="form-label">Please provide a reason for declining this application:</label>
                            <textarea class="form-control" id="declineReason" rows="4" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeclineBtn">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="confirmModalBody">
                    Are you sure you want to approve this application?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="finalConfirmBtn">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample data - In a real application, this would come from the database
            const applicationData = {
                studentLastName: "Dela Cruz",
                studentFirstName: "Juan",
                studentMiddleName: "Santos",
                suffix: "Jr",
                province: "Metro Manila",
                municipality: "Quezon City",
                barangay: "Diliman",
                streetAddress: "123 Sample Street, Green Village",
                zipCode: "1101",
                dateOfBirth: "2005-05-15",
                placeOfBirth: "Quezon City",
                gender: "Male",
                nationality: "Filipino",
                religion: "Roman Catholic",
                gradeLevel: "Grade 10",
                email: "juan.delacruz@gmail.com",
                contactNumber: "09123456789",
                schoolLastAttended: "ABC School",
                fatherFullName: "Pedro Dela Cruz",
                fatherOccupation: "Engineer",
                fatherContactNumber: "09187654321",
                motherFullName: "Maria Dela Cruz",
                motherOccupation: "Teacher",
                motherContactNumber: "09765432109",
                guardianFullName: "Juan S. Dela Cruz",
                relationshipToStudent: "Father",
                guardianContactNumber: "09187654321",
                schoolYear: "2025-2026",
                studentType: "New",
                applyingFor: "Senior High School - Grade 11 - STEM"
            };
            
            // Populate the form with data
            Object.keys(applicationData).forEach(key => {
                const displayElement = document.getElementById('display' + key.charAt(0).toUpperCase() + key.slice(1));
                if (displayElement) {
                    displayElement.textContent = applicationData[key];
                }
            });
            
            // Handle decline button click
            document.getElementById('declineBtn').addEventListener('click', function() {
                const declineModal = new bootstrap.Modal(document.getElementById('declineModal'));
                declineModal.show();
            });
            
            // Handle approve button click
            document.getElementById('approveBtn').addEventListener('click', function() {
                document.getElementById('confirmModalBody').textContent = 'Are you sure you want to approve this application?';
                document.getElementById('finalConfirmBtn').dataset.action = 'approve';
                const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            });
            
            // Handle confirm decline button click
            document.getElementById('confirmDeclineBtn').addEventListener('click', function() {
                const declineReason = document.getElementById('declineReason').value;
                if (!declineReason.trim()) {
                    alert('Please provide a reason for declining.');
                    return;
                }
                
                document.getElementById('confirmModalBody').textContent = 'Are you sure you want to decline this application?';
                document.getElementById('finalConfirmBtn').dataset.action = 'decline';
                document.getElementById('finalConfirmBtn').dataset.reason = declineReason;
                
                const declineModal = bootstrap.Modal.getInstance(document.getElementById('declineModal'));
                declineModal.hide();
                
                const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            });
            
            // Handle final confirmation
            document.getElementById('finalConfirmBtn').addEventListener('click', function() {
                const action = this.dataset.action;
                
                if (action === 'approve') {
                    // Process approval
                    console.log('Application approved');
                    alert('Application has been approved successfully!');
                } else if (action === 'decline') {
                    // Process decline with reason
                    const reason = this.dataset.reason;
                    console.log('Application declined. Reason:', reason);
                    alert('Application has been declined successfully.');
                }
                
                const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
                confirmModal.hide();
                
                // In a real application, redirect to a list of applications or dashboard
                // window.location.href = 'applications.php';
            });
            
            // Handle document view buttons
            const viewButtons = document.querySelectorAll('.btn-view');
            viewButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // In a real application, this would open the document
                    alert('Document viewer would open here.');
                });
            });
        });
    </script>
</body>
</html>