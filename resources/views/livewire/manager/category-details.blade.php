<div class="container-fluid">
    <!-- Breadcrumb-->
    <div class="row pt-2 pb-2">
        <div class="col-sm-9">
            <h4 class="page-title">Category Details Page</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javaScript:void();">{{ config('app.name') }}</a></li>
                <li class="breadcrumb-item"><a href="javaScript:void();">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumb-->
    <div class="row">
        <div class="@if($category->has_sub_category) col-lg-8 @else col-lg-12 @endif">
            <div class="card">
                <div class="card-title">
                    Items
                    <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#item_modal" wire:click="create_item"><i class="fa fa-plus mr-1"></i></button>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead class="thead-primary shadow-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    @if($category->has_sub_category)
                                    @foreach ($sub_categories as $sub_category)
                                    <th scope="col">{{ $sub_category->name }}</th>
                                    @endforeach
                                    @else
                                    <th scope="col">Price</th>
                                    @endif
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category_wise_items as $category_wise_item)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <img src="{{ asset($category_wise_item->item->image ? $category_wise_item->item->image : 'assets/images/no-image.png') }}" width="30px">
                                        {{ $category_wise_item->item->name }}
                                        @if($category->has_sub_item)
                                        <small>
                                            <ol>
                                                @foreach ($category_wise_item->item->sub_items as $sub_tem)
                                                <li>{{ $sub_tem->name }}</li>
                                                @endforeach
                                            </ol>
                                        </small>
                                        @endif
                                    </td>
                                    @if($category->has_sub_category)
                                    @foreach ($sub_categories as $sub_category)
                                    <td> {{ price_helper($category_wise_item->item_id, $category_wise_item->category_id, $sub_category->id) }}</td>
                                    @endforeach
                                    @else
                                    <td>{{ $category_wise_item->price }}</td>
                                    @endif
                                    <td>
                                        <div class="btn-group m-1">
                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target="#item_modal" wire:click="edit_item({{ $category_wise_item }})"><i class="fa fa-edit"></i></button>
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
        @if($category->has_sub_category)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-title">
                    Sub Category
                    <button type="button" class="btn btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#sub_category_modal" wire:click="create_sub_category"><i class="fa fa-plus mr-1"></i></button>
                </div>
                <div class="card-body">
                    <div class="">
                        <table class="table">
                            <thead class="thead-primary shadow-primary">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sub_categories as $sub_category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $sub_category->name }}</td>
                                    <td>
                                        <div class="btn-group m-1">
                                            <button type="button" class="btn btn-warning waves-effect waves-light btn-sm" data-toggle="modal" data-target="#sub_category_modal" wire:click="select_sub_category({{ $sub_category }})"><i class="fa fa-edit"></i></button>
                                            {{-- <button type="button" class="btn btn-danger waves-effect waves-light btn-sm" wire:click="delete_sub_category({{ $sub_category }})"><i class="fa fa fa-trash-o"></i></button> --}}
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
        @endif
    </div>
    <!-- Modal -->
    <div class="modal fade" id="item_modal" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"><i class="fa fa-star"></i> item Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submit_item">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="offline_active">offline active</label>
                                <select class="form-control" wire:model="offline_active" id="offline_active">
                                    <option value="">Select</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                                <x-error name="offline_active" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="online_active">online active</label>
                                <select class="form-control" wire:model="online_active" id="online_active">
                                    <option value="">Select</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                                <x-error name="online_active" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name">name</label>
                                <input type="text" class="form-control" wire:model="name" id="name">
                                <x-error name="name" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="shortcut_number">shortcut number</label>
                                <input type="number" class="form-control" wire:model="shortcut_number" id="shortcut_number">
                                <x-error name="shortcut_number" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="image">image</label>
                                <input type="file" accept="image/*" class="form-control" wire:model="image" id="image">
                                <x-error name="image" />
                            </div>
                            @if($category->has_sub_category)
                            @foreach ($sub_categories as $key => $sub_category)
                            <div class="form-group col-md-12">
                                <label for="sub_category_wise_price_array.{{ $key }}">Price for {{ $sub_category->name }}</label>
                                <input type="number" class="form-control" wire:model="sub_category_wise_price_array.{{ $key }}.price" id="sub_category_wise_price_array.{{ $sub_category->id }}">
                                <x-error name="sub_category_wise_price_array.{{ $key }}" />
                            </div>
                            @endforeach
                            @else
                            <div class="form-group col-md-6">
                                <label for="price">price</label>
                                <input type="number" class="form-control" wire:model="price" id="price">
                                <x-error name="price" />
                            </div>
                            @endif
                            @if($category->has_sub_item)
                            @foreach ($childs as $key => $child)
                            <div class="form-group col-md-12 row">
                                <div class="col-md-9">
                                    <label for="childs.{{ $key }}.name">Child no. {{ $loop->iteration }}</label>
                                    <input type="text" class="form-control" wire:model="childs.{{ $key }}.name" id="childs.{{ $key }}.name" required>
                                    <x-error name="childs.{{ $key }}.name" />
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="w-100 btn btn-danger waves-effect waves-light mt-4" wire:click="add_or_remove_child({{ $key }})">({{ $loop->iteration }}) <i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                            @endforeach
                            <button type="button" class="btn btn-success waves-effect waves-light col-6 m-5" wire:click="add_or_remove_child"><i class="fa fa fa-plus"></i> Add Child </button>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-refresh"></i>Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sub_category_modal" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white"><i class="fa fa-star"></i>Sub Category Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="submit_sub_category">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="sub_category_name">name</label>
                                <input type="text" class="form-control" wire:model="sub_category_name" id="sub_category_name">
                                <x-error name="sub_category_name" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-refresh"></i>
                                Reset</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check-square-o"></i>
                                Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End container-fluid-->
