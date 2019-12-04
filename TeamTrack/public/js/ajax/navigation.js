export function setSidebar() {
    $(".sidebar-link")
        .off("click")
        .click(function(e) {
            console.log("setSidebar called");
            e.preventDefault();
            // Load the content from the link's href attribute
            $(".content").load(
                $(this)
                    .attr("href")
                    .concat(" .content"),
                function(responseText, textStatus, XMLHttpRequest) {
                    initializeFunctions();
                }
            );
            //Change window location
            //window.location.replace($(this).attr('href'));
            window.history.pushState("", "Title", $(this).attr("href"));
        });
}
