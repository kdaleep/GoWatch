<div class="col-md-9 p-4">
    <div class="card shadow-sm">
        
        <div class="card-body">
            <h5 class="card-title d-flex justify-content-end">
                <form class="d-flex me-2" role="search" action="<?= URLROOT ?>/admin/search" method="GET">
                    <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-search"></i></button>
                </form>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addModal">Add Anime</button>
            </h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Episode</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 1; ?>
                        <?php foreach ($data['movies'] as $anime): ?>
                            <tr>
                                <td><?= $index++ ?></td>
                                <td>
                                    <img src="<?= URLROOT ?>/uploads/<?= htmlspecialchars($anime['thumbnail_path']) ?>"
                                        alt="<?= htmlspecialchars($anime['title']) ?>"
                                        style="width: 80px; height: auto;">
                                </td>
                                <td><?= htmlspecialchars($anime['title']) ?></td>
                                <td><?= htmlspecialchars(mb_strimwidth($anime['description'], 0, 150, '...')) ?></td>
                                <td>
                                    <button class="btn btn-success viewBtn"
                                        data-id="<?= $anime['id'] ?>"
                                        data-title="<?= htmlspecialchars($anime['title']) ?>"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addEpisodeModal">
                                        <i class="fa-solid fa-add"></i>
                                    </button>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <button
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal"
                                        data-id="<?= $anime['id'] ?>"
                                        data-title="<?= htmlspecialchars($anime['title']) ?>"
                                        data-description="<?= htmlspecialchars($anime['description']) ?>"
                                        data-year="<?= $anime['year'] ?>"
                                        data-category_id="<?= $anime['category_id'] ?>"
                                        data-path_id="<?= $anime['thumbnail_path'] ?>"
                                        data-is_published="<?= $anime['is_published'] ?>"
                                        data-is_trending="<?= $anime['is_trending'] ?>">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                </td>
                                <td class="d-flex justify-content-center">
                                    <a href="/GoWatch/public/admin/deleteAnime?id=<?= $anime['id'] ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-remove"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Add anime -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Movie/Anime</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= URLROOT ?>/admin/addAnime" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <select class="form-select" id="year" name="year">
                            <option selected disabled>Select year</option>
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2019">2019</option>
                            <option value="-">Others</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option selected disabled>Select category</option>
                            <?php foreach ($data['categoryList'] as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= strtoupper(htmlspecialchars($category['name'])) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail_path" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail_path" name="thumbnail_path">
                    </div>

                    <div class="d-flex mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="is_published" name="is_published">
                            <label class="form-check-label" for="is_published">Is Published</label>
                        </div>

                        <div class="form-check ms-4">
                            <input class="form-check-input" type="checkbox" value="1" id="is_trending" name="is_trending">
                            <label class="form-check-label" for="is_trending">Is Trending</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary ms-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- edit anime -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editAnimeForm" action="<?= URLROOT ?>/admin/updateAnime" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Anime</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="title">
                    </div>

                    <div class="mb-3">
                        <label for="edit_description">Description</label>
                        <textarea class="form-control" id="edit_description" rows="3" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_year">Year</label>
                        <select class="form-select" id="edit_year" name="year">
                            <option value="2025">2025</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                            <option value="2021">2021</option>
                            <option value="2019">2019</option>
                            <option value="-">Others</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_category_id">Category</label>
                        <select class="form-select" id="edit_category_id" name="category_id">
                            <?php foreach ($data['categoryList'] as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= strtoupper(htmlspecialchars($category['name'])) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_thumbnail_path">Thumbnail</label>
                        <input type="hidden" class="form-control" id="edit_thumbnail_path_hidden" name="old_thumbnail_path">
                        <input type="file" class="form-control" id="edit_thumbnail_path" name="thumbnail_path" accept="image/*">
                    </div>


                    <div class="d-flex mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="edit_is_published" name="is_published">
                            <label class="form-check-label" for="edit_is_published">Is Published</label>
                        </div>

                        <div class="form-check ms-4">
                            <input class="form-check-input" type="checkbox" value="1" id="edit_is_trending" name="is_trending">
                            <label class="form-check-label" for="edit_is_trending">Is Trending</label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Anime</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Add Episodes -->
<div class="modal fade" id="addEpisodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAnimeTitle">Anime Title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= URLROOT ?>/admin/addEpisode" method="POST">
                    <input type="hidden" name="anime_id" id="animeIdField">

                    <div class="form-group mb-3">
                        <label>Episode Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Episode No</label>
                        <input type="number" name="ep_no" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Video URL</label>
                        <textarea name="video_url" class="form-control" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label>Duration</label>
                        <input type="text" name="duration" class="form-control" placeholder="e.g. 22:13" required>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="is_published" class="form-check-input" value="1" checked>
                        <label class="form-check-label">Publish Now</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-3">Add Episode</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.querySelectorAll('.viewBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const animeId = this.getAttribute('data-id');
            const animeTitle = this.getAttribute('data-title');

            document.getElementById('modalAnimeTitle').textContent = animeTitle;
            document.getElementById('animeIdField').value = animeId;
        });
    });



    //edit anime modal
    document.addEventListener('DOMContentLoaded', function() {
        const editModal = document.getElementById('editModal');
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;

            document.getElementById('edit_id').value = button.getAttribute('data-id');
            document.getElementById('edit_title').value = button.getAttribute('data-title');
            document.getElementById('edit_description').value = button.getAttribute('data-description');
            document.getElementById('edit_year').value = button.getAttribute('data-year');
            document.getElementById('edit_category_id').value = button.getAttribute('data-category_id');
            document.getElementById('edit_thumbnail_path_hidden').value = button.getAttribute('data-path_id');
            document.getElementById('edit_is_published').checked = button.getAttribute('data-is_published') === "1";
            document.getElementById('edit_is_trending').checked = button.getAttribute('data-is_trending') === "1";
        });
    });
</script>