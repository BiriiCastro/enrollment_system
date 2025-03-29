<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Enrollment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d9d9d9;
        }
        .download-btn {
            cursor: pointer;
        }
        .modal-content {
            border-radius: 8px;
        }
        .modal-body {
            text-align: center;
            padding: 30px;
        }
        .circle-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 1px solid #000;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        /* Increase the card size */
        .enrollment-card {
            max-width: 95%;
            margin: 0 auto;
        }
        /* Make form elements larger */
        .form-control, .form-select, .btn {
            padding: 10px 15px;
            font-size: 16px;
        }
        /* Increase spacing */
        .form-label {
            font-size: 16px;
            margin-bottom: 8px;
        }
        label .required {
            color: red;
        }
        .section-header {
            font-size: 20px;
            margin-top: 25px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Privacy Notice Modal -->
    <div class="modal fade" id="privacyNoticeModal" tabindex="-1" aria-labelledby="privacyNoticeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!--<div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>-->
                <div class="modal-body">
                    <div class="circle-icon">
                        <span>i</span>
                    </div>
                    <p class="mb-4">Notice: All data and information provided herein shall be treated with STRICT CONFIDENTIALITY in accordance with the Data Privacy Act.</p>
                    <button type="button" class="btn btn-primary" id="privacyOkayBtn">Okay</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="applicationSuccessModal" tabindex="-1" aria-labelledby="applicationSuccessLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Added modal-lg class here -->
            <div class="modal-content">
                <!--<div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>-->
                <div class="modal-body text-center p-4">
                    <div class="mb-4">
                        <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="30" cy="30" r="29" stroke="black" stroke-width="2"/>
                            <path d="M20 30L27 37L40 24" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h5 class="mb-3">Your application has been successfully submitted!</h5>
                    <p class="mb-3">We've sent a confirmation email to your registered address with a copy of your submission details. Our admissions team will review your application and contact you within 5-7 business days regarding the next steps.</p>
                    <p class="mb-4">If you have any immediate questions, please contact our Admissions Office at 
                        <a href="mailto:registrar.sjbps@gmail.com">registrar.sjbps@gmail.com</a> or (02) 8296 5896 and 0920 122 5764.
                    </p>
                    <button type="button" class="btn btn-primary px-4" id="successGoHomeBtn">Go Home</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <div class="card shadow enrollment-card">
                    <div class="card-header bg-white py-4">
                        <div class="text-center">
                            <div class="d-flex align-items-center justify-content-between">
                                <h4 class="m-0">St. John the Baptist Parochial School Admission Form</h4>
                                <img src="images/logo/st-johns-logo.png" alt="School Logo" class="rounded-circle" width="80" height="80">
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="enrollmentForm" novalidate>
                            <!-- General Information Section -->
                            <h5 class="section-header fw-bold">General Information</h5>
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="studentLastName" class="form-label">Last Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="studentLastName" name="studentLastName" required>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="studentFirstName" class="form-label">First Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="studentFirstName" name="studentFirstName" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="studentMiddleName" class="form-label">Middle Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="studentMiddleName" name="studentMiddleName" placeholder="N/A if none" required>
                                        <small id="studentMiddleNameError" class="text-danger"></small> <!-- Error Message -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="suffix" class="form-label">Suffix</label>
                                        <select class="form-select" id="suffix" name="suffix">
                                            <option value="">Select Suffix</option> 
                                            <option value="Jr">Jr.</option>
                                            <option value="Sr">Sr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                        </select>
                                    </div>
                                </div>
                                <small id="duplicateError" class="text-danger"></small> <!-- Error Message -->
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="region" class="form-label">Region <span class="required">*</span></label>
                                        <select class="form-select" id="region" name="region" required>
                                            <option value="">Select Region</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="province" class="form-label">Province <span class="required">*</span></label>
                                        <select class="form-select" id="province" name="province" required>
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="municipality" class="form-label">Municipality <span class="required">*</span></label>
                                        <select class="form-select" id="municipality" name="municipality" required>
                                            <option value="">Select Municipality</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="barangay" class="form-label">Barangay <span class="required">*</span></label>
                                        <select class="form-select" id="barangay" name="barangay" required>
                                            <option value="">Select Barangay</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="streetAddress" class="form-label">House Number, Street, Subdivision <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="streetAddress" name="streetAddress" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="zipCode" class="form-label">ZIP Code <span class="required">*</span></label>
                                        <input type="tel" class="form-control" id="zipCode" name="zipCode" placeholder="Enter ZIP Code" required oninput="this.value = this.value.replace(/\D/g, '').slice(0, 5)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dateOfBirth" class="form-label">Date of Birth <span class="required">*</span></label>
                                        <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                                        <small id="dateOfBirthError" class="text-danger"></small> <!-- Error Message -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="placeOfBirth" class="form-label">Place of Birth <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="placeOfBirth" name="placeOfBirth" placeholder="Barangay, Municipality, Province" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gender" class="form-label">Gender <span class="required">*</span></label>
                                        <select class="form-select" id="gender" name="gender" required>
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nationality" class="form-label">Nationality <span class="required">*</span></label>
                                        <select class="form-select" id="nationality" name="nationality" required>
                                            <option value="" disabled selected>Select Nationality</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="religion" class="form-label">Religion <span class="required">*</span></label>
                                        <select class="form-select" id="religion" name="religion" required>
                                            <option value="" disabled selected>Select Religion</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="prevGradeLevel" class="form-label">Previous Grade Level <span class="required">*</span></label>
                                        <select class="form-select" id="prevGradeLevel" name="prevGradeLevel" required >
                                            <option value="" disabled selected>Select Grade Level</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="e.g. john@gmail.com" required>
                                        <small id="email_status"></small>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="contactNumber" class="form-label">Contact Number <span class="required">*</span></label>
                                        <input type="tel" class="form-control" id="contactNumber" name="contactNumber" placeholder="e.g. 09XXXXXXXXX" required oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="schoolLastAttended" class="form-label">School Last Attended <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="schoolLastAttended" name="schoolLastAttended" placeholder="Last School Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="schoolLastAttendedAddress" class="form-label">School Last Attended Address <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="schoolLastAttendedAddress" name="schoolLastAttendedAddress" placeholder="Barangay, Municipality, Province" required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Family Background Section -->
                            <h5 class="section-header fw-bold">Family Background</h5>
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fatherFullName" class="form-label">Father's Full Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="fatherFullName" name="fatherFullName" placeholder="First Name, Middle Name, Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fatherOccupation" class="form-label">Father's Occupation <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="fatherOccupation" name="fatherOccupation" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fatherContactNumber" class="form-label">Father's Contact Number <span class="required">*</span></label>
                                        <input type="tel" class="form-control" id="fatherContactNumber" name="fatherContactNumber" placeholder="e.g. 09XXXXXXXXX" required oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="motherFullName" class="form-label">Mother's Full Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="motherFullName" name="motherFullName" placeholder="First Name, Middle Name, Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="motherOccupation" class="form-label">Mother's Occupation <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="motherOccupation" name="motherOccupation" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="motherContactNumber" class="form-label">Mother's Contact Number <span class="required">*</span></label>
                                        <input type="tel" class="form-control" id="motherContactNumber" name="motherContactNumber" placeholder="e.g. 09XXXXXXXXX" required oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)">

                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardianFullName" class="form-label">Guardian Full Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="guardianFullName" name="guardianFullName" placeholder="First Name, Middle Name, Last Name" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="relationshipToStudent" class="form-label">Relationship to Student <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="relationshipToStudent" name="relationshipToStudent" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="guardianContactNumber" class="form-label">Guardian's Contact Number <span class="required">*</span></label>
                                        <input type="tel" class="form-control" id="guardianContactNumber" name="guardianContactNumber" placeholder="e.g. 09XXXXXXXXX" required oninput="this.value = this.value.replace(/\D/g, '').slice(0, 11)">

                                    </div>
                                </div>
                            </div>
                            
                            <!-- Requirements Section -->
                            <h5 class="section-header fw-bold">Requirements</h5>
                            <div class="row mb-6">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="schoolYear" class="form-label">School Year <span class="required">*</span></label>
                                        <select class="form-select" id="schoolYear" name="schoolYear" required>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="studentType" class="form-label">Type of Student <span class="required">*</span></label>
                                        <select class="form-select" id="studentType" name="studentType" required>
                                            <option value="" disabled selected>Select Type of Student</option>
                                            <option value="old">Old</option>
                                            <option value="new/transferee">New/Transferee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="applyingFor" class="form-label">Applying For <span class="required">*</span></label>
                                        <select class="form-select" id="applyingFor" name="applyingFor" required>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3" id="appointmentField" style="display: none;">
                                    <div class="col-12">
                                        <label class="form-label">Select Appointment for Onsite Interview</label>
                                        <div class="ps-3"> 
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="appointmentDate" class="form-label">Select Date <span class="required">*</span></label>
                                                        <input type="date" class="form-control appointment-validator" id="appointmentDate" name="appointmentDate"  >
                                                    </div>
                                                    <small id="dateError" class="text-danger"></small> <!-- Error Message -->
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group">
                                                        <label for="appointmentTime" class="form-label">Select Time <span class="required">*</span></label>
                                                        <input type="time" class="form-control appointment-validator" id="appointmentTime" name="appointmentTime" min="08:00" max="15:00" >
                                                    </div>
                                                    <small id="timeError" class="text-danger"></small> <!-- Error Message -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3" id="academicTrackField" style="display: none;">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-md-7 mb-3">
                                                <div class="form-group">
                                                    <label for="academicTrack" class="form-label">Select Academic Track <span class="required">*</span></label>
                                                    <select class="form-select academic-validator" id="academicTrack" name="academicTrack">
                                                        <option value="" selected disabled>Select Academic Track</option>
                                                        <option value="STEM">STEM - Science, Technology, Engineering, and Mathematics</option>
                                                        <option value="ABM">ABM - Accountancy, Business, and Management</option>
                                                        <option value="HUMSS">HUMSS - Humanities and Social Sciences</option>
                                                    </select>
                                                </div>
                                                <small id="academicTrackError" class="text-danger"></small> <!-- Error Message -->
                                            </div>
                                            <div class="col-md-5 mb-3">
                                                <div class="form-group">
                                                    <label for="academicSemester" class="form-label">Select Academic Semester <span class="required">*</span></label>
                                                    <select class="form-select academic-validator" id="academicSemester" name="academicSemester">
                                                        <option value="" selected disabled>Select Academic Semester</option>
                                                        <option value="1">1st Semester</option>
                                                        <option value="2">2nd Semester</option>
                                                    </select>
                                                </div>
                                                <small id="academicSemesterError" class="text-danger"></small> <!-- Error Message -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthCertificate" class="form-label">Birth Certificate <span class="required">*</span></label>
                                        <input type="file" class="form-control" id="birthCertificate" name="birthCertificate" required accept=".pdf,.jpg,.jpeg,.png" data-max-size="20971520">
                                        <small class="text-muted">Maximum file size: 20MB. Accepted formats: PDF, JPEG, PNG only</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="reportCard" class="form-label">Copy of Latest Report Card <span class="required">*</span></label>
                                        <input type="file" class="form-control" id="reportCard" name="reportCard" required accept=".pdf,.jpg,.jpeg,.png" data-max-size="20971520">
                                        <small class="text-muted">Maximum file size: 20MB. Accepted formats: PDF, JPEG, PNG only</small>
                                    </div>
                                </div>
                            </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="idPicture" class="form-label">Recent 2X2 ID Picture <span class="required">*</span></label>
                                    <input type="file" class="form-control" id="idPicture" name="idPicture" required accept=".pdf,.jpg,.jpeg,.png" data-max-size="20971520">
                                    <small class="text-muted">Maximum file size: 20MB. Accepted formats: PDF, JPEG, PNG only</small>
                                </div>
                            </div>
                        </div>
                            
                            <!-- Certification -->
                            <div class="mb-4 mt-5" class="certificationContainer">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="certificationCheck" required>
                                    <label class="form-check-label" for="certificationCheck">
                                        I hereby certify that the information provided in this form is complete, true and correct. 
                                        Further, I give my consent to SJBPS administration to collect and process my personal information. 
                                        The data collected in this form will only be used for school purposes only and will not be disclosed to any external sources without your express consent.
                                    </label>
                                    <div id="certError"></div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5">Submit</button>
                                <div id="responseMessage"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Privacy Notice Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const privacyModal = new bootstrap.Modal(document.getElementById("privacyNoticeModal"), {
                backdrop: 'static',  // Prevent closing by clicking outside
                //keyboard: false      // Prevent closing with ESC key
            })

            const privacyOkayBtn = document.getElementById("privacyOkayBtn");

            // Show the Privacy Notice modal first
            privacyModal.show();

            // When clicking "Okay", close the modal
            privacyOkayBtn.addEventListener("click", function () {
                privacyModal.hide();
                
            });
        });
    </script>


    <!-- Inputs in the Admission Form and Some Validation -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            console.log("AJAX Call for Regions Started...");

            // Function to fetch data and populate dropdown
            function fetchData(url, callback) {
                fetch(url)
                    .then(response => response.json())
                    .then(data => callback(data))
                    .catch(error => console.error("Fetch Error:", error));
            }

            // Function to reset dropdowns
            function resetDropdown(dropdown, defaultText) {
                dropdown.innerHTML = `<option value=''>${defaultText}</option>`;
            }

            // Load Regions
            fetch("databases/regions.php")
                .then(response => response.json())
                .then(data => {
                    let regionDropdown = document.getElementById("region");
                    data.forEach(region => {
                        let option = document.createElement("option");
                        option.value = region.id;
                        option.textContent = region.regDesc;
                        regionDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error("Error fetching regions:", error));

            // Event listeners for cascading reset and fetch operations
            document.getElementById("region").addEventListener("change", function() {
                let regionId = this.value;
                let provinceDropdown = document.getElementById("province");
                let municipalityDropdown = document.getElementById("municipality");
                let barangayDropdown = document.getElementById("barangay");
                
                // Reset all lower-level dropdowns
                resetDropdown(provinceDropdown, "Select Province");
                resetDropdown(municipalityDropdown, "Select Municipality");
                resetDropdown(barangayDropdown, "Select Barangay");
                
                if (regionId) {
                    fetchData("databases/provinces.php?regionId=" + regionId, data => {
                        data.forEach(province => {
                            let option = document.createElement("option");
                            option.value = province.id;
                            option.textContent = province.provDesc;
                            provinceDropdown.appendChild(option);
                        });
                    });
                }
            });

            document.getElementById("province").addEventListener("change", function() {
                let provinceId = this.value;
                let municipalityDropdown = document.getElementById("municipality");
                let barangayDropdown = document.getElementById("barangay");
                
                // Reset all lower-level dropdowns
                resetDropdown(municipalityDropdown, "Select Municipality");
                resetDropdown(barangayDropdown, "Select Barangay");
                
                if (provinceId) {
                    fetchData("databases/municipalities.php?provinceId=" + provinceId, data => {
                        data.forEach(municipality => {
                            let option = document.createElement("option");
                            option.value = municipality.id;
                            option.textContent = municipality.citymunDesc;
                            municipalityDropdown.appendChild(option);
                        });
                    });
                }
            });

            document.getElementById("municipality").addEventListener("change", function() {
                let municipalityId = this.value;
                let barangayDropdown = document.getElementById("barangay");
                
                // Reset barangay dropdown
                resetDropdown(barangayDropdown, "Select Barangay");
                
                if (municipalityId) {
                    fetchData("databases/barangays.php?municipalityId=" + municipalityId, data => {
                        data.forEach(barangay => {
                            let option = document.createElement("option");
                            option.value = barangay.id;
                            option.textContent = barangay.brgyDesc;
                            barangayDropdown.appendChild(option);
                        });
                    });
                }
            });

            // Load Nationalities
            fetchData("databases/nationalities.php", function (data) {
                console.log("Nationalities Loaded:", data);
                const nationalitySelect = document.getElementById("nationality");
                data.length ? data.forEach(nationality => {
                    nationalitySelect.innerHTML += `<option value="${nationality.nationality_id}">${nationality.nationality_name}</option>`;
                }) : nationalitySelect.innerHTML = '<option value="">No nationalities found</option>';
            });

            // Load Religions
            fetchData("databases/religions.php", function (data) {
                console.log("Religions Loaded:", data);
                const religionSelect = document.getElementById("religion");
                religionSelect.innerHTML = '<option value="" disabled selected>Select Religion</option>';
                data.length ? data.forEach(religion => {
                    religionSelect.innerHTML += `<option value="${religion.religion_id}">${religion.religion_name}</option>`;
                }) : religionSelect.innerHTML = '<option value="">No religions found</option>';
            });

            // Load Active School Years
            fetchData("databases/school_years.php", function (data) {
                console.log("Active School Years Loaded:", data);
                const schoolYearSelect = document.getElementById("schoolYear");
                schoolYearSelect.innerHTML = '<option value="" disabled selected>Select School Year</option>';
                
                if (data.length > 0) {
                    data.forEach(schoolYear => {
                        schoolYearSelect.innerHTML += `<option value="${schoolYear.school_year_id}">${schoolYear.school_year}</option>`;
                    });
                    schoolYearSelect.value = data[0].school_year_id;
                } else {
                    schoolYearSelect.innerHTML += '<option value="">No school years found</option>';
                }
            });


            // Load Grade Levels
            // Load Grade Levels
            fetchData("databases/grade_levels.php", function (data) {
                console.log("Grade Levels Loaded:", data);
                const prevGradeSelect = document.getElementById("prevGradeLevel");
                const applyingForSelect = document.getElementById("applyingFor");
                const academicTrackField = document.getElementById("academicTrackField");
                const academicTrack = document.getElementById("academicTrack");
                const academicSemester = document.getElementById("academicSemester"); // Fixed typo
                const allGradeLevels = {};

                prevGradeSelect.innerHTML = '<option value="" disabled selected>Select Grade Level</option>';

                data.forEach(grade => {
                    allGradeLevels[grade.grade_level_id] = grade;
                    if (grade.grade_name !== "Grade 12") {
                        prevGradeSelect.innerHTML += `<option value="${grade.grade_level_id}">${grade.grade_name}</option>`;
                    }
                });

                prevGradeSelect.addEventListener("change", function () {
                    const selectedPrev = this.value;
                    console.log("Selected Previous Grade Level ID:", selectedPrev);
                    applyingForSelect.innerHTML = '<option value="" disabled selected>Select Grade Level</option>';
                    academicTrackField.style.display = "none";
                    academicTrack.removeAttribute("required");
                    academicSemester.removeAttribute("required");

                    if (selectedPrev && allGradeLevels[selectedPrev]) { // Added check to prevent errors
                        const nextGrade = getNextGradeLevel(allGradeLevels[selectedPrev].grade_name, allGradeLevels);
                        if (nextGrade) {
                            applyingForSelect.innerHTML += `<option value="${nextGrade.grade_level_id}">${nextGrade.grade_name}</option>`;
                        }
                    }
                });

                applyingForSelect.addEventListener("change", function () {
                    const selectedApplyingFor = this.value;
                    console.log("Selected Applying For Grade Level ID:", selectedApplyingFor);
                    
                    if (selectedApplyingFor && (allGradeLevels[selectedApplyingFor].grade_name === "Grade 11" || allGradeLevels[selectedApplyingFor].grade_name === "Grade 12")) {
                        academicTrackField.style.display = "block";
                        academicTrack.setAttribute("required", "required");
                        academicSemester.setAttribute("required", "required"); // Fixed typo
                    } else {
                        academicTrackField.style.display = "none";
                        academicTrack.removeAttribute("required");
                        academicSemester.removeAttribute("required"); // Fixed typo
                        academicTrack.value = ""; // Reset value
                        academicSemester.value = ""; // Reset value
                    }
                });
            });

            function getNextGradeLevel(currentGrade, allGrades) {
                const gradeOrder = ["Prekindergarten", "Kindergarten", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6", "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"];
                const currentIndex = gradeOrder.indexOf(currentGrade);
                if (currentIndex !== -1 && currentIndex < gradeOrder.length - 1) {
                    const nextGradeName = gradeOrder[currentIndex + 1];
                    return Object.values(allGrades).find(grade => grade.grade_name === nextGradeName);
                }
                return null;
            }


            // Toggle Appointment Fields based on Student Type
            function toggleAppointmentField() {
                let studentType = document.getElementById("studentType").value;
                let appointmentField = document.getElementById("appointmentField");
                let appointmentDate = document.getElementById("appointmentDate");
                let appointmentTime = document.getElementById("appointmentTime");

                if (studentType === "new/transferee") {
                    appointmentField.style.display = "block";
                    appointmentDate.setAttribute("required", "required");
                    appointmentTime.setAttribute("required", "required");
                } else {
                    appointmentField.style.display = "none";
                    appointmentDate.removeAttribute("required");
                    appointmentTime.removeAttribute("required");
                    appointmentDate.value = "";
                    appointmentTime.value = "";
                }
            }

            document.getElementById("studentType").addEventListener("change", toggleAppointmentField);


            // Check Duplicate Student Using AJAX
            async function checkDuplicateStudent() {
                const firstName = document.getElementById("studentFirstName")?.value?.trim() || "";
                const middleName = document.getElementById("studentMiddleName")?.value?.trim() || "";
                const lastName = document.getElementById("studentLastName")?.value?.trim() || "";
                const birthDate = document.getElementById("dateOfBirth")?.value?.trim() || "";
                const gradeApplyingFor = parseInt(document.getElementById("applyingFor")?.value?.trim()) || 0; // Convert to integer

                const duplicateError = document.getElementById("duplicateError");

                if (!firstName || !middleName || !lastName || !birthDate || gradeApplyingFor === 0) {
                    console.log("Please fill in all fields before submitting.");
                    return false;
                }

                console.log("Sending payload:", { firstName, middleName, lastName, birthDate, gradeApplyingFor });

                try {
                    const response = await fetch("databases/check_duplicate_student.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ firstName, middleName, lastName, birthDate, gradeApplyingFor })
                    });

                    if (!response.ok) {
                        console.error(`HTTP error! Status: ${response.status}`);
                        alert("Unable to verify student information at the moment. Please try again later.");
                        return false;
                    }

                    const data = await response.json();
                    console.log("Server Response:", data);

                    if (data.exists) {
                        showError(duplicateError, "A student with the same name, birth date, and grade level is already registered.");
                        alert("A student with the same name, birth date, and grade level is already registered.");
                        return false;
                    }

                    removeError(duplicateError);
                    return true;
                } catch (error) {
                    console.error("Error checking duplicate student:", error);
                    alert("Unable to verify student information at the moment. Please try again later.");
                    return false;
                }
            }


            // **Form Submission**
            document.getElementById("enrollmentForm").addEventListener("submit", async function (event) {
                event.preventDefault(); // Prevent actual form submission

                let isValid = true;
                let requiredFields = document.querySelectorAll("[required]");
                let certificationCheck = document.getElementById("certificationCheck");
                let certError = document.getElementById("certError");
                let emailField = document.getElementById("email");

               // Get form fields first
                let firstNameField = document.getElementById("studentFirstName").value;
                let middleNameField = document.getElementById("studentMiddleName").value;
                let lastNameField = document.getElementById("studentLastName").value;
                let birthDateField = document.getElementById("dateOfBirth").value;
                let studentType = document.getElementById("studentType").value;
                let schoolYear = document.getElementById("schoolYear").value;
                let gradeApplyingFor = parseInt(document.getElementById("applyingFor").value); // Convert to INT
                let academicSemester = document.getElementById("academicSemester").value;


                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        showError(field, "This field is required.");
                    } else {
                        removeError(field);
                    }
                });

                // **Certify Checkbox Validation**
                if (!certificationCheck.checked) {
                    isValid = false;
                    certError.innerHTML = `<small class="text-danger">You must certify the information before submitting.</small>`;
                } else {
                    certError.innerHTML = "";
                }


                // **Check for Duplicate Student Before Submitting**
                console.log("Checking for duplicate student...");
                let isDuplicate = await checkDuplicateStudent();

                if (isDuplicate === false) {
                    console.log("Duplicate student found. Aborting submission.");
                    isValid = false;
                }


                // **Email Format Validation**
                if (emailField) {
                    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test(emailField.value.trim())) {
                        isValid = false;
                        showError(emailField, "Enter a valid email address.");
                    } else {
                        removeError(emailField);
                        await checkEmailExists(emailField.value.trim(), schoolYear, gradeApplyingFor, academicSemester);

                    }
                }
                // **Email Already Exist Validator**
                async function checkEmailExists(email, schoolYear, gradeLevel, academicSemester) {
                    try {
                        // Convert empty string to null for academicSemester
                        if (academicSemester === "") {
                            academicSemester = null;
                        }

                        const requestData = { 
                            email, 
                            schoolYear, 
                            gradeLevel, 
                            academicSemester 
                        };

                        console.log("Sending data:", requestData); // Debug: Check what is being sent

                        const response = await fetch("databases/check_email.php", {
                            method: "POST",
                            body: JSON.stringify(requestData),
                            headers: { "Content-Type": "application/json" }
                        });

                        const text = await response.text();
                        console.log("Raw Response:", text); // Debug: log response

                        const data = JSON.parse(text); 

                        if (data.exists) {
                            showError(emailField, "This email is already registered for the selected school year and/or semester.");
                            alert("This email is already registered for the selected school year and/or semester.");
                            isValid = false;
                        } else {
                            removeError(emailField);
                        }
                    } catch (error) {
                        console.error("Error checking email:", error);
                        showError(emailField, "Unable to verify email at the moment. Please try again later.");
                    }
                }
                
                // Appointment Validator on Student type
                if (studentType == "new/transferee") {
                    let appointmentDateValidator = document.getElementById("appointmentDate").value;
                    let appointmentTimeValidator = document.getElementById("appointmentTime").value;
                    let appointmentRequiredFields = document.querySelectorAll(".appointment-validator");

                    const dateError = document.getElementById("dateError");
                    const timeError = document.getElementById("timeError");

                    appointmentRequiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            removeError(field);
                            showError(dateError, "This field is required.");
                            showError(timeError, "This field is required.");
                        } else {
                            // Check if the selected date is a future date
                            const today = new Date();
                            today.setHours(0, 0, 0, 0); // Reset time to start of the day for comparison
                            const selectedDate = new Date(appointmentDateValidator);

                            if (selectedDate <= today) {
                                showError(dateError, "Please select a future date.");
                                isValid = false;
                            }

                            // Check if the selected time is between 08:00 AM and 03:00 PM
                            const time = appointmentTimeValidator.split(":");
                            const hours = parseInt(time[0], 10);
                            const minutes = parseInt(time[1], 10);
                            
                            const day = selectedDate.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday

                            // Check if the selected date is between Monday (1) and Friday (5)
                            if (day === 0 || day === 6) {
                                showError(dateError, "Please select a date from Monday to Friday.");
                                isValid = false;
                            }

                            if (hours < 8 || hours > 15 || (hours === 15 && minutes > 0)) {
                                showError(timeError, "Please select a time between 08:00 AM and 03:00 PM.");
                                isValid = false;
                            }

                            // Optionally, disable form submission if the validation fails
                            if (!isValid) {
                                event.preventDefault(); // Prevent form submission
                            }
                        }
                    });
                }


                if (gradeApplyingFor == 13 || gradeApplyingFor == 14) {
                    console.log("student is senior high school student");
                    let academicTrackRequiredFields = document.querySelectorAll(".academic-validator");

                    const academicTrackError = document.getElementById("academicTrackError");
                    const academicSemesterError = document.getElementById("academicSemesterError");

                    academicTrackRequiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            removeError(field);
                            showError(academicTrackError, "This field is required.");
                            showError(academicSemesterError, "This field is required.");
                        } else {
                            removeError(academicTrackError);
                            removeError(academicSemesterError);
                        }
                    });
                }

                if (isValid) {
                    let formData = new FormData(this);
                    fetch("databases/submit_form.php", {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.text()) // Change to text() to see raw output
                    .then(data => {
                        console.log("Server response:", data);
                        try {
                            let jsonData = JSON.parse(data);
                            if (jsonData.success) {
                                alert("Registration successful!");
                                // Open the modal

                                const successModal = new bootstrap.Modal(document.getElementById("applicationSuccessModal"), {
                                    backdrop: 'static',  // Prevent closing by clicking outside
                                    keyboard: false      // Prevent closing with ESC key
                                });

                                successModal.show();

                                let userGender = document.getElementById('gender').value;
                                let userSurname = document.getElementById('studentLastName').value; 
                                let userEmail = document.getElementById('email').value;  // Get the email from the response
                                
                                console.log(userEmail, userGender, userSurname); // Debug: Check values
                                if (!userEmail || !userSurname || !userGender) {
                                    alert("Please fill in all required fields.");
                                    return;
                                }

                                fetch('databases/send_registration_email.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: 'email=' + encodeURIComponent(userEmail) +
                                        '&surname=' + encodeURIComponent(userSurname) +
                                        '&gender=' + encodeURIComponent(userGender)
                                })
                                .then(response => response.text())
                                .then(data => {
                                    console.log(data); // Log success or error message
                                    alert(data); // Show success or error message
                                })
                                .catch(error => console.error('Error:', error));


                                document.getElementById("successGoHomeBtn").addEventListener("click", function () {                                    
                                   window.location.href = 'homepage.php'; // Redirect to homepage
                                });


                                document.getElementById("enrollmentForm").reset();
                            } else {
                                alert("Error: " + jsonData.message);
                            }
                        } catch (error) {
                            console.error("Invalid JSON received:", data);
                        }
                    })
                    .catch(error => console.error("Fetch error:", error));


                } else {
                    event.preventDefault();
                    alert("Please fill out all required fields correctly.");
                }
            });
                

            // **Real-time Validation on Input Fields**
            document.querySelectorAll("[required]").forEach(field => {
                field.addEventListener("input", function () {
                    if (this.value.trim()) {
                        removeError(this);
                    } else {
                        showError(this, "This field is required.");
                    }
                });
            });

            // **Real-time Validation for Academic Track**
            const academicTrack = document.getElementById("academicTrack");
            if (academicTrack) {
                academicTrack.addEventListener("change", function () {
                    const academicTrackError = document.getElementById("academicTrackError");
                    if (this.value.trim() === "") {
                        showError(academicTrackError, "This field is required.");
                    } else {
                        removeError(academicTrackError);
                    }
                });
            }

            // **Real-time Validation for Academic Semester**
            const academicSemester = document.getElementById("academicSemester");
            if (academicSemester) {
                academicSemester.addEventListener("change", function () {
                    const academicTrackError = document.getElementById("academicSemesterError");
                    if (this.value.trim() === "") {
                        showError(academicSemesterError, "This field is required.");
                    } else {
                        removeError(academicSemesterError);
                    }
                });
            }

            // **Real-time Validation for Appointment Date and Time**
            document.getElementById("appointmentDate").addEventListener("input", function () {
                const dateError = document.getElementById("dateError");
                const selectedDate = new Date(this.value);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time to start of the day for comparison
                const day = selectedDate.getDay(); // 0 = Sunday, 1 = Monday, ..., 6 = Saturday

                if (selectedDate <= today) {
                    showError(dateError, "Please select a future date.");
                } else if (day === 0 || day === 6) {
                    showError(dateError, "Please select a date from Monday to Friday.");
                } else {
                    removeError(dateError);
                }
            });

            document.getElementById("appointmentTime").addEventListener("input", function () {
                const timeError = document.getElementById("timeError");
                const time = this.value.split(":");
                const hours = parseInt(time[0], 10);
                const minutes = parseInt(time[1], 10);

                if (hours < 8 || hours > 15 || (hours === 15 && minutes > 0)) {
                    showError(timeError, "Please select a time between 08:00 AM and 03:00 PM.");
                } else {
                    removeError(timeError);
                }
            });


            // **Real-time Email Validation**
            document.getElementById("email").addEventListener("input", async function () {
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(this.value.trim())) {
                    showError(this, "Enter a valid email address.");
                    return;
                } else {
                    removeError(this);
                }
            });

            // **Real-time Validation for Checkbox**
            document.getElementById("certificationCheck").addEventListener("change", function () {
                let certError = document.getElementById("certError");
                if (this.checked) {
                    certError.innerHTML = "";
                } else {
                    certError.innerHTML = `<small class="text-danger">You must certify the information before submitting.</small>`;
                }
            });

            function showError(field, message) {
                removeError(field);
                let errorBox = document.createElement("div");
                errorBox.classList.add("error-box");
                errorBox.innerHTML = `<small class="text-danger">${message}</small>`;
                field.insertAdjacentElement("afterend", errorBox);
            }

            function removeError(field) {
                if (field.nextElementSibling?.classList.contains("error-box")) {
                    field.nextElementSibling.remove();
                }
            }
        });
    </script>


<script>
        // Function to prevent typing of invalid characters
        function preventInvalidInput(event) {
            const key = event.key;
            // Allow: alphabets, space, and dot
            if (!/^[A-Za-z\s\.,']$/.test(key)) {
                event.preventDefault();  // Prevent invalid keypress
            }
        }

        // Attach event listeners for keypress to the input fields
        document.getElementById("studentFirstName").addEventListener("keypress", preventInvalidInput);
        document.getElementById("studentMiddleName").addEventListener("keypress", preventInvalidInput);
        document.getElementById("studentLastName").addEventListener("keypress", preventInvalidInput);
        document.getElementById("fatherFullName").addEventListener("keypress", preventInvalidInput);
        document.getElementById("motherFullName").addEventListener("keypress", preventInvalidInput);
        document.getElementById("guardianFullName").addEventListener("keypress", preventInvalidInput);
    </script>

</body>
</html>
   
