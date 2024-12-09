@php
    $Category = (new App\Models\Category())::query()->get();
@endphp
<div class="row d-flex">
    <!-- Danh Mục -->
    <div class="mb-3 me-3" style="max-width: 18rem;">
        <div class="accordion" id="categoryAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fs-6 fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseCategory" aria-expanded="false" aria-controls="collapseCategory">
                        Danh Mục
                    </button>
                </h2>
                <div id="collapseCategory" class="accordion-collapse collapse" data-bs-parent="#categoryAccordion">
                    <div class="accordion-body d-flex justify-content-between">
                        @foreach ($Category as $item)
                            @if ($item->category_parent_id == null)
                                <div>
                                    <li class="nav-item mt-1 fw-medium" style="list-style-type: none;">
                                        <a
                                            href="{{ route('Client.product.category', $item->category_slug) }}">{{ $item->category_name }}</a>
                                    </li>
                                    <ul class="list-unstyled">
                                        @foreach ($Category as $item1)
                                            @if ($item1->category_parent_id == $item->category_id)
                                                <li class="nav-item mt-1 fw-medium">
                                                    <a class="ml-3"
                                                        href="{{ route('Client.product.category', $item1->category_slug) }}">{{ $item1->category_name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Giá -->
    <div class="mb-3 me-3" style="max-width: 18rem;">
        <div class="accordion" id="priceAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed fs-6 fw-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">
                        Giá
                    </button>
                </h2>
                <div id="collapsePrice" class="accordion-collapse collapse" data-bs-parent="#priceAccordion">
                    <div class="accordion-body">
                        <div class="mb-3 d-flex justify-content-start">
                            <input type="radio" name="price[]" value="0-200000" class="me-2" id="">
                            <p>Dưới 200.000 VNĐ</p>
                        </div>
                        <div class="mb-3 d-flex justify-content-start">
                            <input type="radio" name="price[]" value="200000-400000" class="me-2" id="">
                            <p>200.000 VNĐ - 400.000 VNĐ</p>
                        </div>
                        <div class="mb-3 d-flex justify-content-start">
                            <input type="radio" name="price[]" value="400000-600000" class="me-2" id="">
                            <p>400.000 VNĐ - 600.000 VNĐ</p>
                        </div>
                        <div class="mb-3 d-flex justify-content-start">
                            <input type="radio" name="price[]" value="600000-800000" class="me-2" id="">
                            <p>600.000 VNĐ - 800.000 VNĐ</p>
                        </div>
                        <div class="mb-3 d-flex justify-content-start">
                            <input type="radio" name="price[]" value="800000" class="me-2" id="">
                            <p>Trên 800.000 VNĐ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const checkboxes = document.querySelectorAll('input[type="radio"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const selectedValues = [];
            checkboxes.forEach(cb => {
                if (cb.checked) {
                    selectedValues.push(cb.value);
                }
            });
            const url = new URL(window.location.href);
            url.searchParams.set('price', selectedValues.join(','));
            window.location.href = url.toString();
        });
    });
</script>

<style>
    .accordion-collapse {
        position: absolute;
        z-index: 999;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .accordion-item {
        position: relative;
    }

    .accordion-collapse {
        top: 100%;
        left: 0;
        width: 100%;
    }

    .accordion {
        overflow: visible;
    }
</style>
