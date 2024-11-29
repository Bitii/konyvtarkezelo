import axios from "axios";
import "./bootstrap";
import * as bootstrap from "bootstrap";
import jQuery from "jquery";
window.$ = window.jQuery = jQuery;
//import '../scss/app.scss';
//import * as bootstrap from 'bootstrap';
/* $(document).ready(function () {
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
}); */

$(function () {
    // Könyv hozzáadása
    $("#addBook").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        axios
            .post("/books", formData)
            .then(function (resp) {
                if (resp.data.success) {
                    $("#addBook #message").html(
                        '<div class="alert alert-success">' +
                            resp.data.message +
                            "</div>"
                    );
                    $("#addBook")[0].reset();
                    freshTable(resp.data.book, "add");
                }
            })
            .catch(function (error) {
                console.error("Hiba történt: " + error);
                $("#addBook #message").html(
                    '<div class="alert alert-danger">Hiba történt a mentés során!</div>'
                );
            });
    });

    // Könyv hozzáadásakor vagy frissítésekor frissíti a táblázatot
    // nem vagyok abba biztos, hogy szükség van erre, mivel ha a modal-t bezárjuk lefrissül az oldal,(maga a módosításkor nem töltődik újra)
    // hogy az adatbázisban eltárolt legfrissebb adatokat mutassa
    function freshTable(book, action) {
        let coverImage = book.cover_image ? book.cover_image : "";
        let coverAlt = book.cover_image
            ? book.title + " borítókép"
            : "Nincs borítókép";
        let createdAt = new Date(book.created_at).toLocaleDateString("hu-HU", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
        });
        let updatedAt = new Date(book.updated_at).toLocaleDateString("hu-HU", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
        });
        let newRow = `<tr data-id="${book.id}">
                        <td class="fw-bold">${book.title}</td>
                        <td class="text-truncate" style="max-width: 200px;">${book.description}</td>
                        <td>${book.author}</td>
                        <td>${book.genre}</td>
                        <td style="min-width: 100px">${book.release_date}</td>
                        <td class="text-truncate" style="max-width: 200px;">${book.keywords}</td>
                        <td>
                            <img src="${coverImage}" alt="${coverAlt}"
                                class="img-thumbnail" style="width: 80px; height: auto;">
                        </td>
                        <td style="min-width: 100px">${createdAt}</td>
                        <td style="min-width: 100px">${updatedAt}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm m-2 editBtn" data-bs-toggle="modal"
                                data-bs-target="#bookEditModal" data-id="${book.id}">
                                Szerkesztés
                            </button>
                            <button type="button" class="btn btn-danger btn-sm m-2" data-bs-toggle="modal"
                                data-bs-target="#bookDeleteModal">
                                Törlés
                            </button>
                        </td>
                    </tr>`;

        if (action === "add") {
            $("table tbody").append(newRow);
        } else if (action === "edit") {
            let editedRow = $(`table tbody tr[data-id='${book.id}']`);
            if (editedRow.length > 0) {
                editedRow.replaceWith(newRow);
            } else {
                console.warn("A szerkesztett sor nem található a táblázatban!");
                location.reload();
            }
        }
    }

    // Adatok betöltése amikor a szerkesztés gombra kattintunk
    $(document).on("click", ".editBtn", function () {
        let id = $(this).data("id");
        axios
            .get(`/books/${id}/edit`)
            .then(function (resp) {
                let book = resp.data.book;
                $("#editBook").data("id", book.id);
                $("#editTitle").val(book.title);
                $("#editDescription").val(book.description);
                $("#editAuthor").val(book.author);
                $("#editGenre").val(book.genre);
                $("#editReleaseDate").val(book.release_date);
                $("#editKeywords").val(book.keywords);
            })
            .catch(function (error) {
                console.error("Hiba történt: " + error);
                $("#message").html(
                    '<div class="alert alert-danger">Hiba történt az adatok betöltése során!</div>'
                );
            });
    });

    // Szerkesztett adatok mentése
    $("#editBook").on("submit", function (e) {
        e.preventDefault();
        let id = $("#editBook").data("id");
        let formData = new FormData(this);
        formData.append("_method", "PUT");

        axios
            .post(`/books/${id}`, formData)
            .then(function (resp) {
                if (resp.data.success) {
                    $("#editBook #message").html(
                        '<div class="alert alert-success">' +
                            resp.data.message +
                            "</div>"
                    );
                    freshTable(resp.data.book, "edit");
                }
            })
            .catch(function (error) {
                console.error("Hiba történt: " + error);
                $("#editBook #message").html(
                    '<div class="alert alert-danger">Hiba történt a mentés során!</div>'
                );
            });
    });

    // Könyv törlése
    $(document).on("click", ".delBtn", function () {
        let id = $(this).data("id");
        $("#deleteBook").data("id", id);
    });

    $("#deleteBook").on("submit", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        axios
            .delete(`/books/${id}`)
            .then(function (resp) {
                if (resp.data.success) {
                    $(`table tbody tr[data-id='${id}']`).remove();
                    $("#deleteBook #message").html(
                        '<div class="alert alert-success">' +
                            resp.data.message +
                            "</div>"
                    );
                }
            })
            .catch(function (error) {
                console.error("Hiba történt: " + error);
                $("#deleteBook #message").html(
                    '<div class="alert alert-danger">Hiba történt a törlés során!</div>'
                );
            });
        setTimeout(() => {
            const modalElement = document.getElementById("bookDeleteModal");
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
                modalInstance.hide();
            }
        }, 1500);
    });

    // Könyv keresése
    $("#searchBar").on("keyup", function () {
        let search = $(this).val().toLowerCase();
        $("table tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(search) > -1);
        });
    });

    // Könyvhöz tartozó fordítás hozzáadása
    $("#addTranslation").on("submit", function (e) {
        e.preventDefault();
        let bookId = $(this).data("book-id");
        let formData = new FormData(this);

        axios
            .post(`/translations/${bookId}`, formData)
            .then(function (resp) {
                if (resp.data.success) {
                    $("#addTranslation #message").html(
                        '<div class="alert alert-success">' +
                            resp.data.message +
                            "</div>"
                    );
                    $("#addTranslation")[0].reset();
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            })
            .catch(function (error) {
                console.error("Error: " + error);
                $("#addTranslation #message").html(
                    '<div class="alert alert-danger">Error saving translation!</div>'
                );
            });
    });
});
// Modal bezárásakor üríti az üzeneteket és újratölti az oldalt, hogy a legfrissebb adatokat mutassa
$("#bookAddModal").on("hidden.bs.modal", function () {
    $("#addBook #message").html("");
    location.reload();
});
$("#bookEditModal").on("hidden.bs.modal", function () {
    $("#editBook #message").html("");
    location.reload();
});
$("#bookDeleteModal").on("hidden.bs.modal", function () {
    $("#deleteBook #message").html("");
    location.reload();
});
