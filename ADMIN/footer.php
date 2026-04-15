</div>
<footer class="footer-bg text-light pt-5">
    <div class="container">
        <!-- Top Row: Logo and Address -->
        <div class="row mb-4">
            <div class="col-md-4 text-center text-md-start">
                <img src="../IMG/Logo3.png" alt="EduTrack Logo" style="height:100px;">
            </div>
            <div class="col-md-8 text-center text-md-end">
                <h5>School Contact Information</h5>
                <i class="bi bi-geo-alt-fill text-primary"> Addresh : </i>
                <p class="lead">
                <ul>
                    <li>Laxminagar Society, A, G I D C-Ii, Sadar Baug, Junagadh - 362001.</li>
                    <li> Laxmi Nagar Marg, Near Deep Jyoti Palace, Junagadh, Gujarat, 362001</li>
                    <li>GF63+J24, Jayshree Rd, Rayjibaug, Talav Gate, Junagadh, Gujarat 362001</li>
                </ul>
                </p>
                <p class="mb-1">City, State, 000000</p>
                <p class="mb-0">Email: info@edutrack.com | Phone: +91 9876543210</p>
            </div>
        </div>

        <!-- Middle Row: Links and Social Icons -->
        <div class="row mb-4 text-center">
            <div class="col-12">
                <a href="about.php" class="text-warning text-decoration-none me-3">About Us</a>
                <a href="#" class="text-warning text-decoration-none me-3">Courses</a>
                <a href="contact.php" class="text-warning text-decoration-none">Contact</a>
            </div>
            <div class="col-12 mt-3">
                <a href="#"><i class="bi bi-facebook fa-lg text-warning me-3"></i></a>
                <a href="#"><i class="bi bi-twitter fa-lg text-warning me-3"></i></a>
                <a href="#"><i class="bi bi-linkedin fa-lg text-warning"></i></a>
            </div>
        </div>

        <!-- Bottom Row: Terms -->
        <div class="row border-top pt-3">
            <div class="col text-center">
                <p class="mb-0">
                    <a href="#" class="text-warning text-decoration-none me-3">Terms & Conditions</a>
                    <a href="#" class="text-warning text-decoration-none">Privacy Policy</a>
                </p>
                <p class="mt-2 mb-0">&copy; 2025 EduTrack. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>


</body>
<!-- Font Awesome -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    // ✅ Toggle edit mode
    document.getElementById('openEditDetails').addEventListener('click', function() {
        document.getElementById('viewProfile').classList.toggle('d-none');
        document.getElementById('editProfile').classList.toggle('d-none');
        document.getElementById('saveProfileBtn').classList.toggle('d-none');
        this.classList.toggle('d-none');
    });

    // ✅ Save updated profile (name/email)
    document.getElementById('saveProfileBtn').addEventListener('click', function() {
        const name = document.getElementById('editName').value;
        const email = document.getElementById('editEmail').value;

        fetch('../Action/update_profile.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}`
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('✅ Profile updated!');
                    location.reload();
                } else {
                    alert('❌ ' + data.message);
                }
            });
    });

    // ✅ Handle profile image upload + crop
    let cropper;

    document.getElementById('editImageBtn').addEventListener('click', function() {
        document.getElementById('profileImageInput').click();
    });

    document.getElementById('profileImageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(event) {
            const image = document.getElementById('imageToCrop');
            image.src = event.target.result;

            const modal = new bootstrap.Modal(document.getElementById('cropImageModal'));
            modal.show();

            if (cropper) cropper.destroy();

            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                background: false,
                dragMode: 'move',
                cropBoxResizable: false
            });
        };
        reader.readAsDataURL(file);
    });

    document.getElementById('cropAndUploadBtn').addEventListener('click', function() {
        if (!cropper) return;
        cropper.getCroppedCanvas({
            width: 300,
            height: 300,
        }).toBlob(function(blob) {
            const roundCanvas = document.createElement('canvas');
            const ctx = roundCanvas.getContext('2d');
            const size = 300;
            roundCanvas.width = size;
            roundCanvas.height = size;

            const img = new Image();
            img.onload = function() {
                ctx.beginPath();
                ctx.arc(size / 2, size / 2, size / 2, 0, Math.PI * 2);
                ctx.closePath();
                ctx.clip();
                ctx.drawImage(img, 0, 0, size, size);
                roundCanvas.toBlob(function(finalBlob) {
                    const formData = new FormData();
                    formData.append('profile_image', finalBlob);

                    fetch('../action/upload_profile_image.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                document.getElementById('profileImagePreview').src = data.image_url + '?t=' + new Date().getTime();
                                bootstrap.Modal.getInstance(document.getElementById('cropImageModal')).hide();
                            } else {
                                alert(data.message);
                            }

                        });

                });
            };
            img.src = URL.createObjectURL(blob);
        });



    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const classSelect = document.querySelector('select[name="class_id"]');
        const sectionSelect = document.querySelector('select[name="section_id"]');

        if (!classSelect || !sectionSelect) return; // Prevent errors if elements are missing

        classSelect.addEventListener('change', function() {
            const classId = this.value;
            sectionSelect.innerHTML = '<option value="">Loading...</option>';

            if (!classId) {
                sectionSelect.innerHTML = '<option value="">-- Select Class First --</option>';
                return;
            }

            fetch(`timetable.php?ajax=sections&class_id=${classId}`)
                .then(response => response.json())
                .then(data => {
                    sectionSelect.innerHTML = ''; // clear old options

                    if (data.length > 0) {
                        sectionSelect.innerHTML = '<option value="">-- Select Section --</option>';
                        data.forEach(sec => {
                            const option = document.createElement('option');
                            option.value = sec.id;
                            option.textContent = sec.title;
                            sectionSelect.appendChild(option);
                        });
                    } else {
                        sectionSelect.innerHTML = '<option value="">No sections available</option>';
                    }
                })
                .catch(err => {
                    console.error('Error fetching sections:', err);
                    sectionSelect.innerHTML = '<option value="">Error loading</option>';
                });
        });
    });
</script>





</head>

</html>