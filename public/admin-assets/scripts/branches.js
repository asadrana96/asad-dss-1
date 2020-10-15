$(document).ready(function () {

    $("#branches").DataTable();

    let branches_modal = $("#assignBranches");

    $('#branch_to_device_group').select2({
        dropdownParent: branches_modal,
        placeholder: "Select Branch"
    });

    $('#device_group_to_branch').select2({
        dropdownParent: branches_modal,
        placeholder: "Select Device Groups"
    });

    /************ DataTables *****************/
    $("#branches").DataTable();

    $('#assign-device-group-to-device').on('change', function () {
        $('#assign').prop('disabled', !$(this).val());
    }).trigger('change');
    $("#message").hide();

    $(".checkBoxMain").change(function (e) {
        e.preventDefault();

        $(document).find('.sorting_asc').removeClass('sorting_asc');

        $(".magic-checkbox").prop("checked", $(this).prop("checked"))
    });

    $("#deleteBtn").click(function (e) {
        e.preventDefault();

        var data_array = [];

        $.each($(".magic-checkbox:checked"),function () {
            var id = $(this).val();
            if(id.length > 0)
            {
                data_array.push(id)
            }
        });

        if(confirm("Are you sure you want to delete")){
            var route = $("#action").val();
            $.ajax({
                type: "DELETE",
                url: route,
                data: {
                    branches: data_array
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function (response) {
                    console.log(response.message);
                    $("#message strong").text(response.message);
                    $("#message").show();

                    setTimeout(function () {
                        window.location.reload()
                    },2000)
                },
                error: function (message) {
                    console.log(message);
                }
            })
        }
    })


    $('input:checkbox:checked').click(function () {
        console.log($(this).val());
    })

});
