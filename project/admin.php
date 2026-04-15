<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile with Crop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f6f7;
        }

        #profileImage {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
        }

        #cropImage {
            max-width: 100%;
        }

        #profileImage {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            /* makes it round visually */
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-sm p-4 mx-auto text-center" style="max-width:400px;">
            <img src="https://via.placeholder.com/120" id="profileImage" alt="Profile">
            <h4 id="userName">John Doe</h4>
            <p class="text-muted" id="userEmail">john@example.com</p>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" value="John Doe">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" value="john@example.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="editImage" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Crop Modal -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crop Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="cropImage">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="cropBtn">Crop & Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper;

        document.getElementById('editImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = () => {
                document.getElementById('cropImage').src = reader.result;
                new bootstrap.Modal(document.getElementById('cropModal')).show();
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('cropModal').addEventListener('shown.bs.modal', function() {
            const image = document.getElementById('cropImage');
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                preview: '#profileImage'
            });
        });

        document.getElementById('cropModal').addEventListener('hidden.bs.modal', function() {
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
        });

        document.getElementById('cropBtn').addEventListener('click', function() {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas({
                    width: 200,
                    height: 200
                });
                const ctx = canvas.getContext('2d');
                const circleCanvas = document.createElement('canvas');
                const size = 200;
                circleCanvas.width = size;
                circleCanvas.height = size;
                const ctx2 = circleCanvas.getContext('2d');

                // Draw circular mask
                ctx2.save();
                ctx2.beginPath();
                ctx2.arc(size / 2, size / 2, size / 2, 0, 2 * Math.PI);
                ctx2.closePath();
                ctx2.clip();
                ctx2.drawImage(canvas, 0, 0, size, size);
                ctx2.restore();

                // Convert to base64 image
                const roundDataUrl = circleCanvas.toDataURL('image/png');
                document.getElementById('profileImage').src = roundDataUrl;

                bootstrap.Modal.getInstance(document.getElementById('cropModal')).hide();
            }
        });


        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('userName').textContent = document.getElementById('editName').value;
            document.getElementById('userEmail').textContent = document.getElementById('editEmail').value;
            bootstrap.Modal.getInstance(document.getElementById('editProfileModal')).hide();
        });
    </script>
</body>

</html>
