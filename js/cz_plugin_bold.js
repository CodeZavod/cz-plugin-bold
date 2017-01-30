jQuery(function ($) {
    var nativeSettingBlock = $("#sticky-span"),
        button = $("<span>")
            .attr("id", "cz-plugin-bold-span")
            .append(
                $("<input>")
                    .attr("id", "cz-plugin-bold")
                    .attr("name", "cz-plugin-bold")
                    .attr("type", "checkbox")
                    .attr("value", "bold")
            )
            .append(' ')
            .append(
                $("<label>")
                    .attr("for", "cz-plugin-bold")
                    .addClass("selectit")
                    .text("Выделить жирным")
            )
            .append(
                $("<br />")
            );

    if (nativeSettingBlock.length) {
        nativeSettingBlock
            .after(button)
            .attrchange({
                trackValues: true,
                callback: function (e) {
                    var style = {};

                    if (e.attributeName == "style") {
                        e.newValue
                            .split(/;\s*/)
                            .filter(function (item) {
                                return item !== "";
                            })
                            .forEach(function (item) {
                                item = item.split(/:\s*/);
                                style[item[0]] = item[1];
                            });

                        $("#cz-plugin-bold-span").css(style);
                    }
                }
            });
    } else {
        $("#CZPluginBoldFallback")
            .append(button);
    }
});
