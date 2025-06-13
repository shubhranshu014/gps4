$(document).ready(function () {
    const handleAjax = (url, $dropdown, defaultMsg) => {
        $dropdown.empty().append('<option value="">Loading...</option>');
        $.ajax({
            url,
            type: 'GET',
            dataType: 'json',
            success: (data) => {
                $dropdown.empty().append(`<option disabled selected>${defaultMsg}</option>`);
                data && data.length
                    ? data.forEach((item) => $dropdown.append(`<option value="${item.id}">${item.name || item.type || item.part_no || item.model_no || item.COPNo || item.tacNo}</option>`))
                    : $dropdown.append('<option value="">No options available</option>');
            },
            error: () => $dropdown.empty().append('<option value="">Failed to load options</option>'),
        });
    };

    $(".element").on("change", function () {
        const is_vts = $(this).find("option:selected").attr("is_vts");
        const $form = $(this).closest("form");
        const $elementType = $form.find(".element_type");

        is_vts === "0"
            ? $("#countOfSim").length === 0 &&
              $(this).parent().after(`<div class="my-2" id="countOfSim"><label>No. of SIM</label><input type="number" name="no_of_sim" class="form-control form-control-sm"></div>`)
            : $("#countOfSim").remove();

        handleAjax(`/superadmin/fetch/element-type/${$(this).val()}`, $elementType, "Select Element Type");
    });

    $(".element_type, .model-no, .partNo, .tacNo").on("change", function () {
        const $form = $(this).closest("form");
        const targets = {
            ".element_type": [".model-no", "/superadmin/fetch/model-no/", "Select Model No."],
            ".model-no": [".partNo", "/superadmin/fetch/part-no/", "Select Part No."],
            ".partNo": [".tacNo", "/superadmin/fetch/tac-no/", "Select TAC No."],
            ".tacNo": [".cop", "/superadmin/fetch/cop-no/", "Select COP No."],
        };

        const [dropdown, url, defaultMsg] = targets[$(this).attr("class")];
        handleAjax(url + $(this).val(), $form.find(dropdown), defaultMsg);
    });

    $(".add_more").click(function () {
        const $newRow = $(this).closest("form").find(".dynamic_form .row").first().clone();
        $newRow.find("input").val("");
        $newRow.find("select").prop("selectedIndex", 0);
        $(this).closest("form").find(".dynamic_form").append($newRow);
    });

    $(document).on("click", ".remove-row", function () {
        const $rows = $(this).closest("form").find(".dynamic_form .row");
        $rows.length > 1 ? $(this).closest(".row").remove() : alert("You must have at least one row.");
    });
});
