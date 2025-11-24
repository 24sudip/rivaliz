{{-- Setup --}}
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
{{-- Guest Apply Coupon --}}
<script type="text/javascript">
    function applyCoupon() {
        var coupon_name = $('#coupon_name').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {coupon_name: coupon_name},
            url: "/guest/coupon-apply",
            success: function (data) {
                couponCalculation();
                if (data.validity == true) {
                    $('#couponField').hide();
                }
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message
            },
        });
    }
    // Start Coupon Calculation Method
    function couponCalculation() {
        $.ajax({
            type: "GET",
            url: "/coupon-calculation",
            dataType: "json",
            success: function (data) {
                if (data.total) {
                    $('#couponCalField').html(
                        `<tbody>
                        <tr>
                          <td>Subtotal</td>
                          <td class="text-end">৳ ${data.total}</td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Total</th>
                          <th class="text-end">৳ ${data.total}</th>
                        </tr>
                      </tfoot>`
                    );
                } else {
                    $('#couponCalField').html(
                        `<tbody>
                        <tr>
                          <td>Subtotal</td>
                          <td class="text-end">৳ ${data.subtotal}</td>
                        </tr>
                        <tr>
                          <td>Coupon Code</td>
                          <td class="text-end">${data.coupon_code}</td>
                        </tr>
                        <tr>
                          <td>Coupon Discount</td>
                          <td class="text-end">৳ ${data.discount_amount} <span class="crs_btn" title="Remove" onclick="couponRemove()"><i class="fa-solid fa-circle-xmark"></i></span> </td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Grand Total</th>
                          <th class="text-end">৳ ${data.total_amount}</th>
                        </tr>
                      </tfoot>`
                    );
                }
            },
        });
    }
    couponCalculation();
</script>

{{-- Remove Coupon start --}}
<script type="text/javascript">
    function couponRemove() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/coupon-remove",
            success: function (data) {
                couponCalculation();
                $('#couponField').show();
                // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
                // End Message
            },
            // contentType: "application/json; charset=utf-8",
            // data: "data",
        });
    }
</script>
{{-- Remove Coupon end --}}
