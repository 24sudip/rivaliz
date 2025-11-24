@extends('frontend.layout.theme')

@section('content')
    @section('meta_content')
    <title>Sign in - {{ env('APP_NAME') }}</title>
    @endsection



    <!-- profile -->

    <section id="quicktech-prfile" class="pt-100">
        <div class="container mt-4">
          <div class="row mb-5 gapp">
            <div class="col-md-3 text-center quicktech-pro-dflex">
              <div class="quicktech-profile">
                <img
                  src="images/profile.avif"
                  class="rounded-circle quicktech-pro-img"
                  alt="User Image"
                />
              </div>
              <div class="quicktech-profile-name">
                <h5 class="mt-3">Hello,</h5>
                <h4>nadim hasan</h4>
              </div>
            </div>
            <div class="col-md-9">
              <ul class="nav nav-tabs">
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic active"
                    data-bs-toggle="tab"
                    href="#profile"
                    ><img src="images/profile.png" alt="" /> <br />
                    Profile</a
                  >
                </li>
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic"
                    data-bs-toggle="tab"
                    href="#orders"
                  >
                    <img src="images/online-course.png" alt="" /> <br />
                    My Courses</a
                  >
                </li>
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic"
                    data-bs-toggle="tab"
                    href="#address"
                    ><img src="images/location-pin.png" alt="" /> <br />
                    Address</a
                  >
                </li>
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic"
                    data-bs-toggle="tab"
                    href="#password"
                    ><img src="images/reset-password.png" alt="" /> <br />
                    Password</a
                  >
                </li>
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic"
                    data-bs-toggle="tab"
                    href="#wishlist"
                    ><img src="images/wishlist.png" alt="" /> <br />
                    Wish List</a
                  >
                </li>
  
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic"
                    data-bs-toggle="tab"
                    href="#review"
                  >
                    <img src="images/rating(2).png" alt="" /> <br />
                    Review</a
                  >
                </li>
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic"
                    data-bs-toggle="tab"
                    href="#quizresult"
                  >
                    <img src="images/results.png" alt="" /> <br />
                    Quiz Result</a
                  >
                </li>
                <li class="nav-item text-center">
                  <a
                    class="nav-link quicktech-ic"
                    data-bs-toggle="tab"
                    href="#paymenthistory"
                  >
                    <img src="images/payment-method.png" alt="" /> <br />
                    Payment History</a
                  >
                </li>
              </ul>
              <div class="tab-content mt-3">
                <div id="profile" class="tab-pane fade show active">
                  <h4>My Account Information</h4>
                  <div class="row mt-3 gapp">
                    <div class="col-md-12">
                      <div class="card quicktech-card">
                        <div class="card-body">
                          <h5 class="card-title">{{ auth()->user()->name }}</h5>
                          <p class="card-text display-text">
                            nadim hasan
                            <a href="#" class="text-danger edit-toggle"
                              ><i class="fa-regular fa-pen-to-square"></i
                            ></a>
                          </p>
                          <div
                            class="input-group edit-input"
                            style="display: none"
                          >
                            <input
                              type="text"
                              class="form-control"
                              value="nadim hasan"
                            />
                            <button
                              class="btn btn-success quicktech-n-btn"
                              type="button"
                              id="save-name"
                            >
                              <i class="fas fa-check"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card quicktech-card">
                        <div class="card-body">
                          <h5 class="card-title">Birthday</h5>
                          <p class="card-text display-text">
                            <a href="#" class="text-danger edit-toggle"
                              ><i class="fa-regular fa-pen-to-square"></i
                            ></a>
                          </p>
                          <div
                            class="input-group edit-input"
                            style="display: none"
                          >
                            <input type="date" class="form-control" />
                            <button
                              class="btn btn-success quicktech-n-btn"
                              type="button"
                              id="save-birthday"
                            >
                              <i class="fas fa-check"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card quicktech-card">
                        <div class="card-body">
                          <h5 class="card-title">Gender</h5>
                          <p class="card-text display-text">
                            Male
                            <a href="#" class="text-danger edit-toggle"
                              ><i class="fa-regular fa-pen-to-square"></i
                            ></a>
                          </p>
                          <div
                            class="input-group edit-input"
                            style="display: none"
                          >
                            <input
                              type="text"
                              class="form-control"
                              value="Male"
                            />
                            <button
                              class="btn btn-success quicktech-n-btn"
                              type="button"
                              id="save-gender"
                            >
                              <i class="fas fa-check"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="card quicktech-card">
                        <div class="card-body">
                          <h5 class="card-title">District</h5>
                          <p class="card-text display-text">
                            <a href="#" class="text-danger edit-toggle"
                              ><i class="fa-regular fa-pen-to-square"></i
                            ></a>
                          </p>
                          <div
                            class="input-group edit-input"
                            style="display: none"
                          >
                            <input type="text" class="form-control" />
                            <button
                              class="btn btn-success quicktech-n-btn"
                              type="button"
                              id="save-district"
                            >
                              <i class="fas fa-check"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Other tabs content -->
                <div id="orders" class="tab-pane fade">
                  <h4 class="quicktech-order mt-5">Course List</h4>
                  <div class="quicktech-courses-profile-inner mt-3">
                    <div class="quikctech-course-main-profile">
                      <div class="quikctech-profile-course-img">
                        <img src="images/coursedetails.png" alt="" />
                      </div>
                      <div class="quicktech-profile-course-text">
                        <h4>Web Design</h4>
                        <p
                          style="
                            display: -webkit-box;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                          "
                        >
                          The quick, brown fox jumps over a lazy dog. DJs flock by
                          when MTV ax quiz prog. Junk MTV quiz graced by fox
                          whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad
                          nymph, for quick jigs vex! Fox nymphs grab quick-jived
                          waltz. Brick quiz whangs jumpy veldt fox. Bright vixens
                          jump; dozy fowl quack. Quick wafting zephyrs vex bold
                          Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged
                          fop blew my junk TV quiz.
                        </p>
                      </div>
                      <div class="quikctech-course-view-brn-profile">
                        <a href="coursedetails.html">View</a>
                      </div>
                    </div>
                  </div>
                  <div class="quicktech-courses-profile-inner mt-3">
                    <div class="quikctech-course-main-profile">
                      <div class="quikctech-profile-course-img">
                        <img src="images/coursedetails.png" alt="" />
                      </div>
                      <div class="quicktech-profile-course-text">
                        <h4>Web Design</h4>
                        <p
                          style="
                            display: -webkit-box;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                          "
                        >
                          The quick, brown fox jumps over a lazy dog. DJs flock by
                          when MTV ax quiz prog. Junk MTV quiz graced by fox
                          whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad
                          nymph, for quick jigs vex! Fox nymphs grab quick-jived
                          waltz. Brick quiz whangs jumpy veldt fox. Bright vixens
                          jump; dozy fowl quack. Quick wafting zephyrs vex bold
                          Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged
                          fop blew my junk TV quiz.
                        </p>
                      </div>
                      <div class="quikctech-course-view-brn-profile">
                        <a href="coursedetails.html">View</a>
                      </div>
                    </div>
                  </div>
                  <div class="quicktech-courses-profile-inner mt-3">
                    <div class="quikctech-course-main-profile">
                      <div class="quikctech-profile-course-img">
                        <img src="images/coursedetails.png" alt="" />
                      </div>
                      <div class="quicktech-profile-course-text">
                        <h4>Web Design</h4>
                        <p
                          style="
                            display: -webkit-box;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                          "
                        >
                          The quick, brown fox jumps over a lazy dog. DJs flock by
                          when MTV ax quiz prog. Junk MTV quiz graced by fox
                          whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad
                          nymph, for quick jigs vex! Fox nymphs grab quick-jived
                          waltz. Brick quiz whangs jumpy veldt fox. Bright vixens
                          jump; dozy fowl quack. Quick wafting zephyrs vex bold
                          Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged
                          fop blew my junk TV quiz.
                        </p>
                      </div>
                      <div class="quikctech-course-view-brn-profile">
                        <a href="coursedetails.html">View</a>
                      </div>
                    </div>
                  </div>
                  <div class="quicktech-courses-profile-inner mt-3">
                    <div class="quikctech-course-main-profile">
                      <div class="quikctech-profile-course-img">
                        <img src="images/coursedetails.png" alt="" />
                      </div>
                      <div class="quicktech-profile-course-text">
                        <h4>Web Design</h4>
                        <p
                          style="
                            display: -webkit-box;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                          "
                        >
                          The quick, brown fox jumps over a lazy dog. DJs flock by
                          when MTV ax quiz prog. Junk MTV quiz graced by fox
                          whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad
                          nymph, for quick jigs vex! Fox nymphs grab quick-jived
                          waltz. Brick quiz whangs jumpy veldt fox. Bright vixens
                          jump; dozy fowl quack. Quick wafting zephyrs vex bold
                          Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged
                          fop blew my junk TV quiz.
                        </p>
                      </div>
                      <div class="quikctech-course-view-brn-profile">
                        <a href="coursedetails.html">View</a>
                      </div>
                    </div>
                  </div>
                </div>
  
                <div id="address" class="tab-pane fade">
                  <!-- Address content goes here -->
                  <div id="address-book">
                    <h2 class="mt-5">Address Book</h2>
                    <div class="quicktech-add-address text-end">
                      <button class="mb-3" id="add-new-btn">Add New</button>
                    </div>
                    <div class="address-card">
                      <div class="quikctech-num"><p>demo, 01711111111</p></div>
                      <div class="quicktech-address-dflex">
                        <div>
                          <p class="qucitech-old-add" style="color: black">
                            qw wqee2 Parbatipur Dinajpur
                          </p>
                        </div>
                        <div class="quicktech-address-btn">
                          <a class="quicktech-default">Default</a>
                          <a class="quicktech-edit-btn" id="add-new-btnn"
                            ><i class="fa-regular fa-pen-to-square"></i
                          ></a>
                          <a class="quicktech-edit-btn"
                            ><i class="fa-solid fa-trash-can fa-fw"></i
                          ></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- new address -->
                  <div id="new-address-form" class="hidden">
                    <h2 class="quicketch-pro-head mt-5">Create New Address</h2>
                    <div class="quicktech-back-btn text-end">
                      <a class="back-link text-end" id="go-back">Go Back</a>
                    </div>
                    <div class="container mt-1">
                      <form>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Full name*"
                          />
                        </div>
                        <div class="form-group">
                          <label for="phone">Phone Number</label>
                          <input
                            type="text"
                            class="form-control"
                            id="phone"
                            placeholder="Phone Number*"
                          />
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Email address"
                          />
                        </div>
                        <div class="row">
                          <div class="form-group col-lg-6">
                            <label for="district">District</label>
                            <select id="district" class="form-control">
                              <option selected>Select district *</option>
                              <option>...</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6">
                            <label for="zone">Zone</label>
                            <select id="zone" class="form-control">
                              <option selected>Select zone *</option>
                              <option>...</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="address-line">Address line</label>
                          <input
                            type="text"
                            class="form-control"
                            id="address-line"
                            placeholder="Address line*"
                          />
                        </div>
                        <div class="form-group">
                          <label for="remark">Remark</label>
                          <textarea
                            class="form-control"
                            id="remark"
                            rows="3"
                          ></textarea>
                        </div>
                        <div class="quicktech-create-btn text-end mt-2">
                          <button type="submit">Create New Address</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- new address -->
  
                  <!-- edit address -->
                  <div id="edit-address-form" class="hidden">
                    <h2 class="quicketch-pro-head mt-5">Edit Address</h2>
                    <div class="quicktech-back-btn text-end">
                      <a class="back-link text-end" id="go-backk">Go Back</a>
                    </div>
                    <div class="container mt-1">
                      <form>
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Full name*"
                          />
                        </div>
                        <div class="form-group">
                          <label for="phone">Phone Number</label>
                          <input
                            type="text"
                            class="form-control"
                            id="phone"
                            placeholder="Phone Number*"
                          />
                        </div>
                        <div class="form-group">
                          <label for="email">Email address</label>
                          <input
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Email address"
                          />
                        </div>
                        <div class="row">
                          <div class="form-group col-lg-6">
                            <label for="district">District</label>
                            <select id="district" class="form-control">
                              <option selected>Select district *</option>
                              <option>...</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-6">
                            <label for="zone">Zone</label>
                            <select id="zone" class="form-control">
                              <option selected>Select zone *</option>
                              <option>...</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="address-line">Address line</label>
                          <input
                            type="text"
                            class="form-control"
                            id="address-line"
                            placeholder="Address line*"
                          />
                        </div>
                        <div class="form-group">
                          <label for="remark">Remark</label>
                          <textarea
                            class="form-control"
                            id="remark"
                            rows="3"
                          ></textarea>
                        </div>
                        <div class="quicktech-create-btn text-end mt-2">
                          <button type="submit">Create New Address</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- edit address -->
                </div>
                <div id="password" class="tab-pane fade">
                  <h4 class="quicketch-pro-head mt-5">Password Content</h4>
                  <!-- Password content goes here -->
                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="card quicktech-change-pass">
                        <div class="card-body">
                          <form>
                            <div class="form-group">
                              <label for="currentPassword"
                                >Current Password</label
                              >
                              <input
                                type="password"
                                class="form-control"
                                id="currentPassword"
                                placeholder="Enter current password"
                                required
                              />
                            </div>
                            <div class="form-group">
                              <label for="newPassword">New Password</label>
                              <input
                                type="password"
                                class="form-control"
                                id="newPassword"
                                placeholder="Enter new password"
                                required
                              />
                            </div>
                            <div class="form-group">
                              <label for="confirmPassword"
                                >Confirm New Password</label
                              >
                              <input
                                type="password"
                                class="form-control"
                                id="confirmPassword"
                                placeholder="Confirm new password"
                                required
                              />
                            </div>
                            <div class="quicktech-changepass-btn mt-3">
                              <button type="submit">Save Change Password</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="wishlist" class="tab-pane fade">
                  <h4 class="quicketch-pro-head" mt-4>WishList</h4>
                  <!-- Wish List content goes here -->
                  <div class="quicktech-courses-profile-inner mt-3">
                    <div class="quikctech-course-main-profile">
                      <div class="quikctech-profile-course-img">
                        <img src="images/coursedetails.png" alt="" />
                      </div>
                      <div class="quicktech-profile-course-text">
                        <h4>Web Design</h4>
                        <p
                          style="
                            display: -webkit-box;
                            -webkit-line-clamp: 1;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                          "
                        >
                          The quick, brown fox jumps over a lazy dog. DJs flock by
                          when MTV ax quiz prog. Junk MTV quiz graced by fox
                          whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad
                          nymph, for quick jigs vex! Fox nymphs grab quick-jived
                          waltz. Brick quiz whangs jumpy veldt fox. Bright vixens
                          jump; dozy fowl quack. Quick wafting zephyrs vex bold
                          Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged
                          fop blew my junk TV quiz.
                        </p>
                      </div>
                      <div
                        class="quikctech-course-view-brn-profile d-flex gap-2 align-items-center"
                      >
                        <a href="coursedetails.html">View</a>
                        <button><i class="fa-solid fa-trash"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="points" class="tab-pane fade">
                  <h4>Points Content</h4>
                  <!-- Points content goes here -->
                </div>
                <div id="coupon" class="tab-pane fade">
                  <h4>Coupon Content</h4>
                  <!-- Coupon content goes here -->
                </div>
                <div id="review" class="tab-pane fade">
                  <h4>Review Content</h4>
                  <!-- Review content goes here -->
                </div>
                <div id="quizresult" class="tab-pane fade">
                  <h4>Quiz Details</h4>
  
                  <table class="table table-bordered mt-4">
                    <thead>
                      <tr>
                        <th class="text-center quicktech-q-heading">Serial</th>
                        <th class="text-center quicktech-q-heading">
                          Course Name
                        </th>
                        <th class="text-center quicktech-q-heading">
                          Date Taken
                        </th>
                        <th class="text-center quicktech-q-heading">
                          Total Time
                        </th>
                        <th class="text-center quicktech-q-heading">View</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center quicktech-q-heading">1</td>
                        <td class="text-center quicktech-q-heading">
                          Introduction to AI
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-20
                        </td>
                        <td class="text-center quicktech-q-heading">3 hrs</td>
                        <td class="text-center quicktech-q-heading">
                          <a href="quizresult.html">View Details</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">2</td>
                        <td class="text-center quicktech-q-heading">
                          Advanced Python
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-22
                        </td>
                        <td class="text-center quicktech-q-heading">5 hrs</td>
                        <td class="text-center quicktech-q-heading">
                          <a href="quizresult.html">View Details</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">3</td>
                        <td class="text-center quicktech-q-heading">
                          Web Development Basics
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-24
                        </td>
                        <td class="text-center quicktech-q-heading">4 hrs</td>
                        <td class="text-center quicktech-q-heading">
                          <a href="quizresult.html">View Details</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">4</td>
                        <td class="text-center quicktech-q-heading">
                          Machine Learning 101
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-25
                        </td>
                        <td class="text-center quicktech-q-heading">6 hrs</td>
                        <td class="text-center quicktech-q-heading">
                          <a href="quizresult.html">View Details</a>
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">5</td>
                        <td class="text-center quicktech-q-heading">
                          Data Visualization
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-26
                        </td>
                        <td class="text-center quicktech-q-heading">2 hrs</td>
                        <td class="text-center quicktech-q-heading">
                          <a href="quizresult.html">View Details</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- Referral content goes here -->
                </div>
                <div id="paymenthistory" class="tab-pane fade">
                  <h4>Payment History</h4>
  
                  <table class="table table-bordered mt-4">
                    <thead>
                      <tr>
                        <th class="text-center quicktech-q-heading">Serial</th>
                        <th class="text-center quicktech-q-heading">
                          Course Name
                        </th>
                        <th class="text-center quicktech-q-heading">
                          Purchase Date
                        </th>
                        <th class="text-center quicktech-q-heading">Price</th>
                        <th class="text-center quicktech-q-heading">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center quicktech-q-heading">1</td>
                        <td class="text-center quicktech-q-heading">
                          Introduction to AI
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-20
                        </td>
                        <td class="text-center quicktech-q-heading">৳150</td>
                        <td class="text-center quicktech-q-heading">Completed</td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">2</td>
                        <td class="text-center quicktech-q-heading">
                          Advanced Python
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-22
                        </td>
                        <td class="text-center quicktech-q-heading">৳200</td>
                        <td class="text-center quicktech-q-heading">
                          In Progress
                        </td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">3</td>
                        <td class="text-center quicktech-q-heading">
                          Web Development Basics
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-24
                        </td>
                        <td class="text-center quicktech-q-heading">৳120</td>
                        <td class="text-center quicktech-q-heading">Completed</td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">4</td>
                        <td class="text-center quicktech-q-heading">
                          Machine Learning 101
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-25
                        </td>
                        <td class="text-center quicktech-q-heading">৳250</td>
                        <td class="text-center quicktech-q-heading">Pending</td>
                      </tr>
                      <tr>
                        <td class="text-center quicktech-q-heading">5</td>
                        <td class="text-center quicktech-q-heading">
                          Data Visualization
                        </td>
                        <td class="text-center quicktech-q-heading">
                          2025-01-26
                        </td>
                        <td class="text-center quicktech-q-heading">৳180</td>
                        <td class="text-center quicktech-q-heading">Completed</td>
                      </tr>
                    </tbody>
                  </table>
                  <!-- Referral content goes here -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- profile -->
@endsection