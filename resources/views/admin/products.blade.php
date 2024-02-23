@extends("admin.adminLayout")
@section("title", "Danh sách sản phẩm")
@section("content")
    <style>
        .create-form-container {
            display: none; /* Hide the container by default */
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        #createProductForm {
            /* Add styles for your form if needed */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin-top: 15%;
        }

        .table tr td {
            border-bottom: 1px solid #ddd;
        }

        .pagination {
            width: 100%;
            display: flex;
        }
    </style>

    <div class="d-flex justify-content-around">
        <div>
            <button id="showCreateForm">Create new product</button>
        </div>
        <div>
            <input placeholder="Search by name or id..." />
        </div>
    </div>

    <div id="createFormContainer" class="create-form-container">
        <form id="createProductForm" style="display: none;"
            action="{{ route('dashboard.store') }}"
            method="POST"
        >
            @csrf
            <table class="table">
                <tr>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="name"  placeholder="Name..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="price"  placeholder="Price..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="height"  placeholder="Height..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="length_col"  placeholder="Length..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="width"  placeholder="Width..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="base_unit" placeholder="Unit..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="producer"  placeholder="Producer..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control" name="quantity"  placeholder="Quantity..." />
                    </td>
                    <td class="align-middle col-1">
                        <input form="createProductForm" class="form-control bg-dark text-white" type="submit" value="Create"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <table class="table mt-4">
        <thead class="thead-dark">
        <tr class="text-center">
            <th scope="col" class="align-middle">Id</th>
            <th scope="col" class="align-middle col-3">Name</th>
            <th scope="col" class="align-middle">Price</th>
            <th scope="col" class="align-middle">Height</th>
            <th scope="col" class="align-middle">Length</th>
            <th scope="col" class="align-middle">Width</th>
            <th scope="col" class="align-middle">Base Unit</th>
            <th scope="col" class="align-middle">Producer</th>
            <th scope="col" class="align-middle">Quantity</th>
            <th scope="col" colspan="2" class="align-middle">Option</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr class="text-center">
                <td class="align-middle">{{ $product->id }}</td>
                <td class="align-middle"><a href="/dashboard/products/{{$product->id}}">{{ $product->name }}</a></td>
                <td class="align-middle">{{ $product->price }}</td>
                <td class="align-middle">{{ $product->height }}</td>
                <td class="align-middle">{{ $product->length_col }}</td>
                <td class="align-middle">{{ $product->width }}</td>
                <td class="align-middle">{{ $product->base_unit }}</td>
                <td class="align-middle">{{ $product->producer }}</td>
                <td class="align-middle">{{ $product->quantity }}</td>
                <td class="align-middle"><a href="/dashboard/products/{{$product->id}}">View</a></td>
                <td class="align-middle">
                    <form action="{{ route('dashboard.destroy', ['id' => $product->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="pagination">
        {{ $products->onEachSide(5)->links() }}
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ session('message') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            @if(session('status') && session('message'))

            const status = "{{ session('status') }}";
            const message = "{{ session('message') }}";

            // Show the modal based on the message status
            if (status === 'success') {
                alert(message)
            }
            @endif

            $("#showCreateForm").click(function () {
                $("#createProductForm").toggle();
                $(".create-form-container").toggle(); // Toggle the visibility of the container
            });

            $(".create-form-container").click(function (event) {
                if (event.target === this) {
                    $("#createProductForm").hide();
                    $(this).hide();
                }
            });
        });
    </script>
@endsection
