@extends('layouts.app_admin')
   
@section('content')

<div class="row">
        <div class="col-md-12">
            <form action="#" method="get" autocomplete="off">
                <div class="row border-top border-bottom pl-2 py-3">         
                    <div class="col-md-6 col-sm-6 pt-2">
                        <div class="row justify-content-around search_div date_wise_div" id="date_selector">
                            {{-- <label class="col-md-2 col-sm-2 m-0 pt-1">{{ __('single_search.from') }}</label> --}}
                            <label class="col-md-5 col-sm-5 m-0 pt-1">Employee Name</label>
                            <div class="col-md-7 col-sm-7 px-3">
                                <div class="input-group input-group-sm">
                                    <select name="emp_name[]" multiple="multiple" class="form-control select2">
                                        @foreach ($all_users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name_en }}</option>
                                        @endforeach                                          
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 pt-2">
                        <div class="row justify-content-around search_div date_wise_div" id="date_selector">
                            {{-- <label class="col-md-2 col-sm-2 m-0 pt-1">{{ __('single_search.from') }}</label> --}}
                            <label class="col-md-3 col-sm-3 m-0 pt-1">Date</label>
                            <div class="col-md-9 col-sm-9 px-3">
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style=" height: 31px !important;">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <input type="date" name="start_date" class="form-control-sm form-control datedata" id="" value="<?=!empty($_GET['start_date'])?$_GET['start_date']:''?>">
                                </div> 
                            </div>
            
                        </div>
                        
                    </div>
                    {{-- <div class="col-md-3 col-sm-3 pt-2">
                        <div class="row justify-content-around search_div date_wise_div" id="date_selector">
            
                            <label class="col-md-3 col-sm-3 m-0 pt-1">To</label>
                            <div class="col-md-9 col-sm-9 px-3">
                                
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text" style=" height: 31px !important;">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                    <input type="date" name="end_date" class="form-control-sm form-control datedata" id="" value="<?=!empty($_GET['end_date'])?$_GET['end_date']:''?>">
                                </div>
                            </div>
                        </div>
            
            
                        
                    </div> --}}
                    <div class="col-md-2 col-sm-2 text-right pr-2 pt-2 pr-2 ">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" id="application_custom_search"><i class="fa fa-search mr-2 p-2"
                                aria-hidden="true"></i>Search
                                {{-- {{ __('single_search.search') }} --}}
                        </button>
                    </div>
            
            
                </div>
            </form>
        </div>
</div>
@endsection