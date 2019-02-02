(function (__nodeNs__, __nodeId__) {
    $.widget(__nodeNs__ + "." + __nodeId__, $.ewma.node, {
        options: {},

        __create: function () {
            var w = this;
            var o = w.options;
            var $w = w.element;

            if (o.resizableClosestSelector) {
                var $heightSource = $(".editor", $w);

                var updateHeightTimeout;

                $w.closest(o.resizableClosestSelector).rebind("resize." + __nodeId__, function () {
                    clearTimeout(updateHeightTimeout);

                    updateHeightTimeout = setTimeout(function () {
                        var $ace = $w.find(".ace_editor");

                        if ($ace.length) {
                            var id = $ace.attr("id");

                            var $aceContainer = $("#" + id);

                            if ($aceContainer.length) {
                                $aceContainer.height($heightSource.height());

                                ace.edit(id).resize();
                            }
                        }
                    }, 10);
                });
            }
        }
    });
})(__nodeNs__, __nodeId__);
