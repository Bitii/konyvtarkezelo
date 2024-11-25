import './bootstrap';
import 'bootstrap';
import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;
//import '../scss/app.scss';
//import * as bootstrap from 'bootstrap';
$(document).ready(function () {
    $("#addBook").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "/books",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $("#message").html(
                    '<div class="alert alert-success">Könyv sikeresen hozzáadva!</div>'
                );
                $("#addBook")[0].reset(); // Reset the form
            },
            error: function (xhr, status, error) {
                $("#message").html(
                    '<div class="alert alert-danger">Hiba történt a mentés során!</div>'
                );
            },
        });
    });
});