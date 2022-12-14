<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">Expense Page</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Expense Page</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumb-->
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
            <div class="card gradient-bloody">
                <div class="card-body p-4">
                    <div class="media">
                        <div class="media-body text-left">
                            <h4 class="text-white">{{ money_format_india($expenses->sum('amount')) }}</h4>
                            <span class="text-white">Total Expenses</span>
                        </div>
                        <div class="align-self-center w-icon"><i class="icon-wallet text-white"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <input type="date" class="form-control" wire:model="expense_date">
                        </div>
                        <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#modal"><i class="fa fa-plus mr-1"></i> Create </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-primary shadow-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Today's History</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expense_categories as $expense_category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        {{ $expense_category->name }}
                                    </td>
                                    <td>
                                        @foreach ($expenses->where('category_id', $expense_category->id) as $expense)
                                        <span class="badge badge-danger m-1" title="{{ $expense->title ?? 'N/A' }}">
                                            {{ $expense->amount }} TK
                                            <a href="javascript:void(0)" wire:click="select_for_delete({{ $expense->id }})" data-toggle="modal" data-target="#delete_modal" title="Delete" class="badge badge-success ml-1">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </span>
                                        @endforeach
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-primary shadow-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Short Note (Title)</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expense_categories as $expense_category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        {{ $expense_category->name }}
                                    </td>
                                    <td>
                                        <input type="text" class="form-control @error(" expense_fields.$expense_category->id.title") bg-danger @enderror" placeholder="Title" wire:model="expense_fields.{{ $expense_category->id }}.title">
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control @error(" expense_fields.$expense_category->id.amount") bg-danger @enderror" placeholder="Amount" wire:model="expense_fields.{{ $expense_category->id }}.amount">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="button" wire:click="add_expense({{ $expense_category->id }})">+</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Delete Modal -->
    <div wire:ignore.self class="modal fade" id="delete_modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p>Are you sure want to delete?</p>
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End container-fluid-->
