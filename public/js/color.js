(function ($) {

    Annotator.Plugin.Color = function (element, message) {
        var plugin = {};

        plugin.pluginInit = function () {
            this.annotator
                .subscribe("annotationCreated", function (annotation) {
                    console.log(annotation);
                })
                .subscribe("annotationUpdated", function (annotation) {
                    console.info("The annotation: %o has just been updated!", annotation)
                })
                .subscribe("annotationDeleted", function (annotation) {
                    console.info("The annotation: %o has just been deleted!", annotation)
                });

            this.annotator.viewer.addField({
                load: function (field, annotation) {
                    field.innerHTML = message;
                }
            });
        };

        return plugin;
    }

})();