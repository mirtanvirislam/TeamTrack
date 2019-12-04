import { setSidebar } from "navigations";

document.onload = initializeFunctions();

function initializeFunctions() {
    console.log("ajax loaded");
    setSidebar();
}

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
});
