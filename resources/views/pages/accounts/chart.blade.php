<x-default-layout>
    <style>
        summary.no-style-sum {
         list-style: none;
        }
    </style>
  <h1>Chart of Accounts</h1>
    
    <div class="card mt-5">
        <div class="card-body">

            @foreach ($accounts as $account)
            <details open>
                <summary><a href="javascript:void(0);" data-get="{{ url('get-account/'.$account->id) }}" data-f-url="{{ route('accounts.update',$account->id) }}" class="text-dark single-account">{{ $account->account_name }} ({{ $account->account_type }})</a></summary>
                @if(!empty($account->children))
                    <ul>
                        @foreach ($account->children as $child)
                        <li>
                            <details>
                                <summary class="{{ count($child->children) == 0 ? 'no-style-sum' : '' }}">
                                    <a href="javascript:void(0);" data-get="{{ url('get-account/'.$child->id) }}" data-f-url="{{ route('accounts.update',$child->id) }}" class="text-dark single-account">
                                        {{ $child->account_name }} ({{ $child->account_type }})
                                    </a>
                                </summary>
                                <ul>
                                    @foreach ($child->children as $child_2)
                                    <li>
                                        <details>
                                            <summary class="{{ count($child_2->children) == 0 ? 'no-style-sum' : '' }}">
                                                <a href="javascript:void(0);" data-get="{{ url('get-account/'.$child_2->id) }}" data-f-url="{{ route('accounts.update',$child_2->id) }}" class="text-dark single-account">
                                                    {{ $child_2->account_name }} ({{ $child_2->account_type }})
                                                </a>
                                            </summary>
                                            
                                            @foreach ($child_2->children as $child_3)
                                                <ul>
                                                    <li>{{ $child_3->account_name }} ({{ $child_3->account_type }})</li>
                                                </ul>
                                            @endforeach
                                        </details>
                                    </li>
                                    @endforeach
                                </ul>
                            </details>
                        </li>
                        @endforeach


                        {{-- @foreach ($account->children as $child)
                            @if(!empty($child->children))
                            <li>
                                <a href="javascript:void(0);" data-get="{{ url('get-account/'.$child->id) }}" data-f-url="{{ route('accounts.update',$child->id) }}" class="text-dark single-account">
                                {{ $child->account_name }} ({{ $child->account_type }})
                            </a></li>
                            @else
                            <li>
                                <a href="javascript:void(0);" data-get="{{ url('get-account/'.$child->id) }}" data-f-url="{{ route('accounts.update',$child->id) }}" class="text-dark single-account">
                                {{ $child->account_name }} ({{ $child->account_type }})
                            </a></li>
                            @endif
                        @endforeach --}}
                    </ul>
                @endif
            </details>
        @endforeach

        </div>
    </div>

    {{-- Modal Start --}}
    <div class="modal fade modal-lg" id="EditAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-primary pt-5 pb-5">
                    <h5 class="modal-title text-white fs-2" id="exampleModalLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <form class="pt-1" id="edit-account-form" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-4">
                                <label class="form-label" for="">Account Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg border-dark" placeholder="" name="account_name" value="" required />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label" for="">Account Type<span class="text-danger">*</span></label>
                                <select name="account_type" class="form-select form-select-sm" required>
                                    <option value="">-- Select --</option>
                                    <option value="asset">Asset</option>
                                    <option value="liability">Liability</option>
                                    <option value="equity">Equity</option>
                                    <option value="revenue">Revenue</option>
                                    <option value="expense">Expense</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Parent Account</label>
                                <select name="parent_account_id" class="form-select form-select-sm" required>
                                    <option value="">No Parent Account</option>
                                    @foreach ($accounts as $parent_account)
                                            <option value="{{ $parent_account->id }}" {{ $parent_account->id == $account->parent_account_id ? 'selected' : '' }}>{{ $parent_account->account_name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                        </div>
                    </form>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="add-close-btn" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="$('#edit-account-form').submit();" id="submit-update-btn" class="btn btn-primary">Update</button>
                </div>
            
            </div>
        </div>
    </div>
    {{-- Modal End --}}

    @push('scripts')
        <script>
            $(document).on("click",".single-account",function () {
                var action = $(this).attr('data-f-url');
                var url = $(this).attr('data-get');
                $('#edit-account-form').attr('action',action);

                $.ajax({
                    type: "GET",
                    url: url,
                    data: {},
                    success: function (response) {
                        $('#EditAccount').modal('toggle');
                        $('input[name="account_name"]').val(response.account_name);                        
                        $('select[name="account_type"]').val(response.account_type);                        
                        $('select[name="parent_account_id"]').val(response.parent_account_id);                        
                    }
                });
            });
        </script>
    @endpush
</x-default-layout>
