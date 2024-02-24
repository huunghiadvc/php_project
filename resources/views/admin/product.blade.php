@extends("admin.adminLayout")
@section("title", "Chỉnh sửa sản phẩm")
@section("content")

    <table class="table col-12 custom-table">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col" class="align-middle col-1">Id</th>
                <th scope="col" class="align-middle col-2">Name</th>
                <th scope="col" class="align-middle col-1">Price</th>
                <th scope="col" class="align-middle col-1">Height</th>
                <th scope="col" class="align-middle col-1">Length</th>
                <th scope="col" class="align-middle col-1">Width</th>
                <th scope="col" class="align-middle col-1">Base Unit</th>
                <th scope="col" class="align-middle col-2">Producer</th>
                <th scope="col" class="align-middle col-1">Quantity</th>
                <th scope="col" class="align-middle col-1">Option</th>
            </tr>
        </thead>
        <tbody>

            <tr class="text-center">
                <td class="align-middle">{{ $product->id }}</td>
                <td class="align-middle">{{ $product->name }}</td>
                <td class="align-middle">{{ $product->price }}</td>
                <td class="align-middle">{{ $product->height }}</td>
                <td class="align-middle">{{ $product->length_col }}</td>
                <td class="align-middle">{{ $product->width }}</td>
                <td class="align-middle">{{ $product->base_unit }}</td>
                <td class="align-middle">{{ $product->producer }}</td>
                <td class="align-middle">{{ $product->quantity }}</td>
                <td class="align-middle"><input class="bg-dark text-white form-control" id="edit_btn" type="submit" value="Edit" /></td>
            </tr>

            <tr class="edit_form text-center">
                <td colspan="10" class="align-middle"><b>Enter Product Change Information Below</b></td>
            </tr>

            <tr class="edit_form text-center">
                <td class="align-middle col-1">
                    <form
                        id="form"
                        action="{{ route('dashboard.update', ['id' => $product->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        {{ $product->id }}
                    </form>
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="name" value={{$product->name}}  placeholder="Name..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="price" value={{$product->price}}  placeholder="Price..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="height" value={{$product->height}}  placeholder="Height..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="length_col" value={{$product->length_col}}  placeholder="Length..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="width" value={{$product->width}}  placeholder="Width..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="base_unit" value={{$product->base_unit}} placeholder="Unit..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="producer" value={{$product->producer}}  placeholder="Producer..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control" name="quantity" value={{$product->quantity}} placeholder="Quantity..." />
                </td>
                <td class="align-middle col-1">
                    <input form="form" class="form-control bg-dark text-white" type="submit" value="Update"/>
                </td>
            </tr>

            @if(session('success'))
            <tr class="text-center">
                <td colspan="10" class="align-middle">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </td>
            </tr>
            @endif

        </tbody>
    </table>

    <script>
        window.addEventListener('load', function() {
            const editBtn = document.getElementById('edit_btn');
            editBtn.addEventListener('click', function() {
                document.querySelectorAll('.edit_form').forEach(function(element) {
                    element.classList.toggle('hidden');
                    element.classList.toggle('show');
                });
                editBtn.value = (editBtn.value === 'Edit') ? 'Cancel' : 'Edit';
            });
        });
    </script>
@endsection
