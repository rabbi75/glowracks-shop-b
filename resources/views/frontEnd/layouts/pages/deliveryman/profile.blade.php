                @extends('frontEnd.layouts.pages.deliveryman.master') 
@section('title','Profile') 
@section('content')
<section class="breadcrumb-section">
  <div class="col-sm-12">
    <div class="bread_inner">
      <div class="row">
        <div class="col-sm-6 col-6">
          <div class="admin-dashboard">
            <h5>Deliveryman Profile</h5>
          </div>
        </div>
        <div class="col-sm-6 col-6">
          <div class="cust-breadcrumb">
            <ul>
              <li><a href="{{asset('/deliveryman/account')}}">Home</a></li>
              <li>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
              </li>
              <li>
                <a href="" class="bread_last"> Profile</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="profile_section">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="profile-area">
        <div class="profile-item">
          <div class="profile_pic">
            <a href="">
              <img src="{{asset($profile->image)}}" style="width: 100px;" alt="" />
            </a>
          </div>
          <div class="profile-item-text">
            <p>{{$profile->name}}</p>
            <p class="st_id">ID. {{$profile->id}}</p>
          </div>
        </div>

        <div class="profile-info">
          <h3>deliveryman Information</h3>
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td>Join Date</td>
                <td>{{date('M, d, Y', strtotime($profile->created_at))}}</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>{{$profile->name}}</td>
              </tr>
              <tr>
                <td>Contact No</td>
                <td>{{$profile->phonenumber}}</td>
              </tr>
              <tr>
                <td>Email</td>
                <td>{{$profile->email}}</td>
              </tr>
              <tr>
                <td>Occupation</td>
                <td>{{$profile->designation}}</td>
              </tr>
              <tr>
                <td>Image</td>
                <td><img src="{{asset($profile->image)}}" alt="" class="small_image" /></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
