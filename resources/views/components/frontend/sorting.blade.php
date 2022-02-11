<div class="col-12 pb-1">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
            <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
        </div>
        @php
            $query = request()->input('query');
        @endphp
        <form action="" id="sortingForm">
            <div class="ml-2">
                <div class="btn-group">
                    <select name="query" id="sorting" class="btn btn-sm btn-light ">
                        <option value="latest" @if ($query === 'latest')
                        selected
                        @endif>Latest</option>
                        <option value="oldest" @if ($query === 'oldest')
                        selected
                        @endif>Oldest</option>
                        <option value="most_view"  @if ($query === 'most_view')
                        selected
                        @endif>Most View</option>
                        <option value="popularity" @if ($query === 'popularity')
                        selected
                        @endif>Popularity</option>
                        <option value="best_selling"  @if ($query === 'best_selling')
                        selected
                        @endif>Best Selling</option>
                    </select>

                </div>
                <div class="btn-group ml-2">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">10</a>
                        <a class="dropdown-item" href="#">20</a>
                        <a class="dropdown-item" href="#">30</a>
                    </div>
                </div>
            </div>
    </form>
    </div>
</div>


@push('script')
    <script>
        const $$ = (el) => document.querySelector(el);

        const sortingForm = $$('#sortingForm');
        const sorting = $$('#sorting');

        sorting.addEventListener('change',function(e){

            sortingForm.submit();
        })

    </script>
@endpush
