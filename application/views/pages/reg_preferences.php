

<!-- <h1>Registration Preferences</h1> -->
<p>Email: <?php echo $email; ?></p>
<p>UID: <?php echo $uid; ?></p>

<!-- Trigger Button
<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalStep1">
        Start Process
    </button>
</div>
-->

<!-- Modal 1 -->
<div class="modal fade" id="modalStep1" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 850px;">
    <div class="modal-content p-4" style="border: 2px solid rgb(79, 208, 255); border-radius: 20px;">
      <div class="modal-header">
        <h5 class="modal-title">1/3 What activities interests you?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form id="activityForm">

            <div class="btn-group mb-2" role="group" aria-label="Activity Toggles">
                <input type="checkbox" class="btn-check" name="activities" id="swimming" autocomplete="off" value="Swimming">
                <label class="btn btn-outline-primary" for="swimming">Swimming</label>

                <input type="checkbox" class="btn-check" name="activities" id="hiking" autocomplete="off" value="Hiking">
                <label class="btn btn-outline-primary" for="hiking">Hiking</label>

                <input type="checkbox" class="btn-check" name="activities" id="islandHopping" autocomplete="off" value="Island Hopping">
                <label class="btn btn-outline-primary" for="islandHopping">Island Hopping</label>

                <input type="checkbox" class="btn-check" name="activities" id="museumViewing" autocomplete="off" value="Museum Viewing">
                <label class="btn btn-outline-primary" for="museumViewing">Museum Viewing</label>

                <input type="checkbox" class="btn-check" name="activities" id="snorkeling" autocomplete="off" value="Snorkeling">
                <label class="btn btn-outline-primary" for="snorkeling">Snorkeling</label>

                <input type="checkbox" class="btn-check" name="activities" id="otherActivity" autocomplete="off" value="Other">
                <label class="btn btn-outline-primary" for="otherActivity">Other</label>
            </div>

            <div class="mb-3 mt-2" id="otherInputContainer" style="display: none;">
                <label for="otherInput" class="form-label">Please specify:</label>
                <div class="form-control" id="tagInputWrapper" style="min-height: 38px; display: flex; flex-wrap: wrap; gap: 5px;">
                    <input type="text" class="border-0 flex-grow-1" id="otherInput" placeholder="Type and press Enter" style="outline: none; min-width: 150px;">
                </div>
                <input type="hidden" name="otherInputList" id="otherInputList">
            </div>

        </form>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#modalStep2" data-bs-toggle="modal" data-bs-dismiss="modal">Next</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal 2 -->
<div class="modal fade" id="modalStep2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 850px;">
    <div class="modal-content p-4" style="border: 2px solid rgb(79, 208, 255); border-radius: 20px;">
      <div class="modal-header">
        <h5 class="modal-title">2/3 Any cities you've always wanted to visit?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label for="cityInput" class="form-label">Enter cities you'd love to visit:</label>
        <input type="text" id="cityInput" class="form-control" placeholder="Type a city and press Enter">

        <div id="cityTags" class="mt-3 d-flex flex-wrap gap-2">
            <!-- Tags will be displayed here -->
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-target="#modalStep1" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
        <button class="btn btn-primary" data-bs-target="#modalStep3" data-bs-toggle="modal" data-bs-dismiss="modal">Next</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div class="modal fade" id="modalStep3" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 850px;">
    <div class="modal-content p-4" style="border: 2px solid rgb(79, 208, 255); border-radius: 20px;">
      <div class="modal-header">
        <h5 class="modal-title">3/3 Which cities have you been to?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <label for="cityInputVisited" class="form-label">Enter cities you've visited:</label>
        <input type="text" id="cityInputVisited" class="form-control" placeholder="Type a city and press Enter">

        <div id="cityTagsVisited" class="mt-3 d-flex flex-wrap gap-2">
            <!-- Tags will be displayed here -->
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-target="#modalStep2" data-bs-toggle="modal" data-bs-dismiss="modal">Back</button>
        <button type="submit" class="btn btn-primary" id="submitPreferences">Finish</button>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- Script for auto show modal -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('modalStep1'));
    modal.show();
  });
</script>


<!-- Modal 1: Other activity toggle -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const otherCheckbox = document.getElementById('otherActivity');
    const otherInputContainer = document.getElementById('otherInputContainer');

    if (otherCheckbox) {
      otherCheckbox.addEventListener('change', function () {
        otherInputContainer.style.display = this.checked ? 'block' : 'none';
      });

      // Optional: initialize state on load (e.g. if user clicked back)
      otherInputContainer.style.display = otherCheckbox.checked ? 'block' : 'none';
    }
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const otherCheckbox = document.getElementById('otherActivity');
    const otherInputContainer = document.getElementById('otherInputContainer');
    const tagInput = document.getElementById('otherInput');
    const tagWrapper = document.getElementById('tagInputWrapper');
    const hiddenInput = document.getElementById('otherInputList');
    let tags = [];

    // Toggle visibility of input container
    if (otherCheckbox) {
      otherCheckbox.addEventListener('change', function () {
        otherInputContainer.style.display = this.checked ? 'block' : 'none';
        if (!this.checked) {
          tags = [];
          renderTags();
        }
      });
      otherInputContainer.style.display = otherCheckbox.checked ? 'block' : 'none';
    }

    // Handle enter key to add tag
    tagInput.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && tagInput.value.trim() !== '') {
        e.preventDefault();
        tags.push(tagInput.value.trim());
        tagInput.value = '';
        renderTags();
      }
    });

    // Render tag chips and update hidden input
    function renderTags() {
      // Clear all tags before rendering
      tagWrapper.querySelectorAll('.tag-chip').forEach(el => el.remove());

      tags.forEach((tag, index) => {
        const span = document.createElement('span');
        span.className = 'badge bg-primary tag-chip';
        span.textContent = tag;

        const removeBtn = document.createElement('button');
        removeBtn.type = 'button';
        removeBtn.className = 'btn-close btn-close-white btn-sm ms-2';
        removeBtn.setAttribute('aria-label', 'Remove');
        removeBtn.onclick = () => {
          tags.splice(index, 1);
          renderTags();
        };

        span.appendChild(removeBtn);
        tagWrapper.insertBefore(span, tagInput);
      });

      hiddenInput.value = tags.join(',');
    }
  });
</script>



<!-- Modal 2 script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('cityInput');
    const tagContainer = document.getElementById('cityTags');
    let cities = [];

    input.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && input.value.trim() !== '') {
        e.preventDefault();
        const city = input.value.trim();

        if (!cities.includes(city)) {
          cities.push(city);
          addTag(city);
        }

        input.value = '';
      }
    });

    function addTag(city) {
      const tag = document.createElement('span');
      tag.className = 'badge bg-info text-dark px-3 py-2 rounded-pill';
      tag.textContent = city;

      const closeBtn = document.createElement('button');
      closeBtn.className = 'btn-close btn-close-white ms-2';
      closeBtn.style.filter = 'invert(1)';
      closeBtn.style.fontSize = '0.6rem';
      closeBtn.addEventListener('click', function () {
        tag.remove();
        cities = cities.filter(c => c !== city);
      });

      tag.appendChild(closeBtn);
      tagContainer.appendChild(tag);
    }

    // OPTIONAL: Store city list globally or submit with form on Next click
    window.getSelectedCities = () => cities;
  });
</script>



<!-- Modal 3 script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const inputVisited = document.getElementById('cityInputVisited');
    const tagContainerVisited = document.getElementById('cityTagsVisited');
    let visitedCities = [];

    inputVisited.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' && inputVisited.value.trim() !== '') {
        e.preventDefault();
        const city = inputVisited.value.trim();

        if (!visitedCities.includes(city)) {
          visitedCities.push(city);
          addTagVisited(city);
        }

        inputVisited.value = '';
      }
    });

    function addTagVisited(city) {
      const tag = document.createElement('span');
      tag.className = 'badge bg-secondary text-light px-3 py-2 rounded-pill';
      tag.textContent = city;

      const closeBtn = document.createElement('button');
      closeBtn.className = 'btn-close btn-close-white ms-2';
      closeBtn.style.filter = 'invert(1)';
      closeBtn.style.fontSize = '0.6rem';
      closeBtn.addEventListener('click', function () {
        tag.remove();
        visitedCities = visitedCities.filter(c => c !== city);
      });

      tag.appendChild(closeBtn);
      tagContainerVisited.appendChild(tag);
    }

    // Optional: make accessible globally
    window.getVisitedCities = () => visitedCities;
  });
</script>


<!-- Submit Button script -->
<script>
  $(document).ready(function () {
    $('#submitPreferences').on('click', function (e) {
      e.preventDefault();

      // 1. Activities
      const selectedActivities = [];
      $('input[name="activities"]:checked').each(function () {
        selectedActivities.push($(this).val());
      });

      const otherInputList = $('#otherInputList').val();
      if (otherInputList) {
        selectedActivities.push(...otherInputList.split(',').map(i => i.trim()));
      }

      // 2. Cities to Visit
      const citiesToVisit = typeof getSelectedCities === 'function' ? getSelectedCities() : [];

      // 3. Cities Visited
      const visitedCities = typeof getVisitedCities === 'function' ? getVisitedCities() : [];

      const id = <?php echo $uid; ?>

      let array = {
          activities: selectedActivities,
          cities_to_visit: citiesToVisit,
          cities_visited: visitedCities,
          id: id
        };

      // AJAX to controller
      $.ajax({
        url: "<?= base_url('Preference/process_preference') ?>",
        type: 'POST',
        data: JSON.stringify(array),

        dataType: 'json',
        success: function (response) {
          alert("An error occurred while submitting your preferences.");
        },

        error: function (xhr, status, error) {
          //alert("Preferences saved successfully!");
          window.location.href="<?= base_url('Home') ?>"
        }

      });
    });
  });
</script>



