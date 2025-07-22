<div class="container-fluid bg-dark pt-5">
    <div class="container p-0 shadow-lg rounded overflow-hidden">
        <!-- Title Row -->
        <div class="row bg-black mt-3 py-3 px-4">
            <div class="col">
                <h4 class="text-white m-0">Now Streaming</h4>
            </div>
        </div>

        <div class="row g-0">
            <!-- Sidebar with Episode List -->
            <div class="col-md-3 p-4" style="background-color: #313536;">
                <table class="table table-dark table-hover table-bordered-0">
                    <thead>
                        <p class="text-white">List of episodes:</p>
                    </thead>
                    <tbody id="episodeList">
                        <?php foreach ($data['episodeList'] as $index => $ep): ?>
                            <tr class="episode-item" data-src="<?= $ep['video_url'] ?>" data-index="<?= $index ?>" style="cursor: pointer;">
                                <td><?= $ep['ep_no'] ?></td>
                                <td><?= $ep['title'] ?><i class="d-flex justify-content-end fa-solid fa-circle-play"></i></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Video Player Section -->
            <div class="col-md-9 bg-black text-white p-4">
                <iframe
                    src="<?= convertGoogleDriveLink($data['episodeList'][0]['video_url']) ?>"
                    id="animePlayer"
                    width="100%"
                    height="480"
                    allow="autoplay"
                    class="rounded shadow-sm border-0">
                </iframe>


                <!-- Episode Info -->
                <div class="mt-4 bg-secondary bg-gradient p-4 rounded shadow-sm">
                    <div class="alert alert-danger mb-3">
                        <strong>You are watching:</strong> Episode
                        <span id="currentEp"><?= $data['episodeList'][0]['ep_no'] ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <button class="btn btn-outline-primary btn-sm">HD-1</button>
                        <button class="btn btn-outline-secondary btn-sm">HD-2</button>
                        <span class="text-info ms-auto">Estimated next episode:
                            <?= date('m/d/Y, h:i:s A', strtotime('+7 days')) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
function convertGoogleDriveLink($url)
{
    if (preg_match('/\/file\/d\/([a-zA-Z0-9_-]+)\//', $url, $matches)) {
        $fileId = $matches[1];
        return "https://drive.google.com/file/d/{$fileId}/preview";
    }
    return $url;
}

?>

<script>
    const episodeItems = document.querySelectorAll('.episode-item');
    const player = document.querySelector('#animePlayer');
    let episodeList = [];

    // Load all episode sources
    episodeItems.forEach((row, index) => {
        const src = row.getAttribute('data-src');
        episodeList.push(src);

        row.addEventListener('click', () => {
            const idx = parseInt(row.getAttribute('data-index'));
            player.src = getPlayableUrl(src);
            player.dataset.currentIndex = idx;
            player.play();

            // Optional: highlight selected row
            document.querySelectorAll('.episode-item').forEach(el => el.classList.remove('table-primary'));
            row.classList.add('table-primary');
        });
    });

    // Auto play next episode
    player.addEventListener('ended', () => {
        let currentIndex = parseInt(player.dataset.currentIndex || 0);
        let nextIndex = currentIndex + 1;
        if (nextIndex < episodeList.length) {
            const nextSrc = episodeList[nextIndex];
            player.src = getPlayableUrl(nextSrc);
            player.dataset.currentIndex = nextIndex;
            player.play();

            // Optional: highlight next row
            document.querySelectorAll('.episode-item').forEach(el => el.classList.remove('table-primary'));
            document.querySelector(`.episode-item[data-index="${nextIndex}"]`)?.classList.add('table-primary');
        }
    });

    // Convert Google Drive to playable preview link
    function getPlayableUrl(src) {
        if (src.includes('drive.google.com')) {
            const match = src.match(/\/file\/d\/([^/]+)\//);
            if (match) {
                return `https://drive.google.com/file/d/${match[1]}/preview`;
            }
        }
        return src;
    }
</script>
