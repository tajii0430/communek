@extends('layouts.app')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet" />

<div class="dashboard-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Edit Complaint</h2>

        <a href="/barangay/complaints"
            class="btn btn-secondary">

            Back

        </a>

    </div>

    <form method="POST"
        action="/barangay/complaints/update/{{ $complaint->id }}">

        @csrf

        <div class="mb-3">

            <label class="form-label">

                Complainant Name

            </label>

            <input type="text"
                name="complainant_name"
                class="form-control"
                value="{{ $complaint->complainant_name }}"
                required>

        </div>

        <div class="mb-3">

            <div class="mb-3">

                <label class="form-label">

                    Categories

                </label>

                <input type="text"
                    id="editCategorySearch"
                    class="form-control mb-2"
                    placeholder="Search category...">

                @php

                $selectedCategories =
                json_decode($complaint->category, true);

                @endphp

                <div class="border rounded p-3"
                    style="max-height:250px;
        overflow-y:auto;">

                    @foreach($categories as $category)

                    <div class="edit-category-item mb-2">

                        <div class="form-check">

                            <input class="form-check-input"
                                type="checkbox"
                                name="category[]"
                                value="{{ $category }}"
                                id="edit{{ Str::slug($category) }}"

                                {{ in_array($category, $selectedCategories ?? [])
                        ? 'checked'
                        : '' }}>

                            <label class="form-check-label"
                                for="edit{{ Str::slug($category) }}">

                                {{ $category }}

                            </label>

                        </div>

                    </div>

                    @endforeach

                </div>

            </div>

        </div>

</div>

<div class="mb-3">

    <label class="form-label">

        Description

    </label>

    <textarea name="description"
        class="form-control"
        rows="5"
        required>{{ $complaint->description }}</textarea>

</div>

<button class="btn btn-primary">

    Update Complaint

</button>

</form>

</div>

<script>
    document.getElementById('categorySearch')
        .addEventListener('keyup', function() {

            let value = this.value.toLowerCase();

            let options =
                document.querySelectorAll(
                    '#categorySelect option'
                );

            options.forEach(option => {

                option.style.display =
                    option.text.toLowerCase()
                    .includes(value) ?
                    '' :
                    'none';

            });

        });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const editSearch =
            document.getElementById('editCategorySearch');

        if (editSearch) {

            editSearch.addEventListener('input', function() {

                let value =
                    this.value.toLowerCase();

                document.querySelectorAll('.edit-category-item')
                    .forEach(function(item) {

                        let text =
                            item.innerText.toLowerCase();

                        if (text.includes(value)) {

                            item.style.display = 'block';

                        } else {

                            item.style.display = 'none';

                        }

                    });

            });

        }

    });
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@endsection