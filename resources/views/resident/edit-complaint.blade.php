@extends('layouts.resident')

@section('content')

<style>
    .mobile-wrapper {
        padding-bottom: 120px;
    }

    .hero-card {
        background: linear-gradient(to right, #0f172a, #1e293b);
        padding: 40px 30px;
        border-radius: 0 0 40px 40px;
        margin-bottom: 25px;
    }

    .hero-subtitle {
        color: #cbd5e1;
        font-size: 20px;
    }

    .hero-title {
        color: white;
        font-size: 48px;
        font-weight: bold;
        margin-top: 10px;
    }

    .card {
        background: white;
        margin: 20px;
        padding: 25px;
        border-radius: 30px;
    }

    .section-title {
        font-size: 18px;
        font-weight: bold;
        color: #0f172a;
        margin-bottom: 12px;
        margin-top: 20px;
    }

    .input {
        width: 100%;
        padding: 18px;
        border: none;
        border-radius: 18px;
        background: #f1f5f9;
        font-size: 16px;
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    textarea.input {
        min-height: 150px;
        resize: none;
    }

    .update-btn {
        width: 100%;
        border: none;
        background: #2563eb;
        color: white;
        padding: 18px;
        border-radius: 18px;
        font-size: 16px;
        font-weight: bold;
    }

    .category-wrapper {
        margin-bottom: 20px;
    }

    .dropdown-button {
        width: 100%;
        background: #6b7280;
        color: white;
        padding: 18px;
        border-radius: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-weight: bold;
        box-sizing: border-box;
    }

    .dropdown-menu {
        display: none;
        background: white;
        border-radius: 18px;
        padding: 15px;
        margin-top: 10px;
        border: 1px solid #e2e8f0;
    }

    .dropdown-menu.active {
        display: block;
    }

    .category-search {
        width: 100%;
        padding: 14px;
        border-radius: 14px;
        border: 1px solid #cbd5e1;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    .category-list {
        max-height: 250px;
        overflow-y: auto;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        border-radius: 12px;
    }

    .category-item:hover {
        background: #f1f5f9;
    }
</style>

<div class="mobile-wrapper">

    <div class="hero-card">

        <div class="hero-subtitle">
            Resident Portal
        </div>

        <div class="hero-title">
            Edit Complaint
        </div>

    </div>

    <div class="card">

        <form
            method="POST"
            action="/resident/complaints/update/{{ $complaint->id }}"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="section-title">

                Select Categories

            </div>

            <div class="category-wrapper">

                <div class="dropdown-button" id="dropdownButton">

                    <span id="selectedCategories">

                        Select Categories

                    </span>

                    <span>
                        ▼
                    </span>

                </div>

                <div class="dropdown-menu" id="dropdownMenu">

                    <input
                        type="text"
                        id="categorySearch"
                        class="category-search"
                        placeholder="Search category...">

                    <div class="category-list" id="categoryList">

                        @php

                        $categories = [

                        'Noise Complaint',
                        'Road Issue',
                        'Sanitation',
                        'Flooding',
                        'Illegal Parking',
                        'Street Light Issue',
                        'Garbage Collection',
                        'Water Problem',
                        'Electricity Problem',
                        'Public Disturbance',
                        'Drainage Issue',
                        'Animal Complaint',
                        'Construction Issue',
                        'Health Concern',
                        'Domestic Issue',
                        'Fire Hazard',
                        'Vandalism',
                        'Traffic Concern'

                        ];

                        $selectedCategories = json_decode($complaint->category);

                        @endphp

                        @foreach($categories as $category)

                        <label class="category-item">

                            <input
                                type="checkbox"
                                name="category[]"
                                value="{{ $category }}"
                                class="category-checkbox"

                                {{ in_array($category, $selectedCategories) ? 'checked' : '' }}>

                            <span>

                                {{ $category }}

                            </span>

                        </label>

                        @endforeach

                    </div>

                </div>

            </div>

            <div class="section-title">

                Description

            </div>

            <textarea
                class="input"
                name="description"
                required>{{ $complaint->description }}</textarea>

            <div class="section-title">

                Replace Image

            </div>

            <input
                type="file"
                class="input"
                name="image">

            <button class="update-btn">

                Update Complaint

            </button>

        </form>

    </div>

</div>

<script>
    const dropdownButton =
        document.getElementById('dropdownButton');

    const dropdownMenu =
        document.getElementById('dropdownMenu');

    const selectedCategories =
        document.getElementById('selectedCategories');

    const categorySearch =
        document.getElementById('categorySearch');

    dropdownButton.onclick = () => {

        dropdownMenu.classList.toggle('active');

    };

    function updateSelectedCategories() {

        const checked =
            document.querySelectorAll(
                '.category-checkbox:checked'
            );

        let values = [];

        checked.forEach(item => {

            values.push(item.value);

        });

        selectedCategories.innerText =
            values.length > 0 ?
            values.join(', ') :
            'Select Categories';

    }

    document
        .querySelectorAll('.category-checkbox')
        .forEach(item => {

            item.addEventListener(
                'change',
                updateSelectedCategories
            );

        });

    updateSelectedCategories();

    categorySearch.addEventListener(
        'keyup',
        function() {

            let value =
                this.value.toLowerCase();

            let items =
                document.querySelectorAll(
                    '.category-item'
                );

            items.forEach(item => {

                item.style.display =
                    item.innerText
                    .toLowerCase()
                    .includes(value) ?
                    'flex' :
                    'none';

            });

        }
    );
</script>

@endsection