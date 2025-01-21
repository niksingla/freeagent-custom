elementorCommon.elements.$window.on("elementor/nested-element-type-loaded", (function() {
    class e extends elementor.modules.elements.types.NestedElementBase {
        getType() {
            return "jws-nested-slider"
        }
    }
    elementor.elementsManager.registerElementType(new e)
    
    
}));

elementorCommon.elements.$window.on("elementor/nested-element-type-loaded", (function() {
    class e extends elementor.modules.elements.types.NestedElementBase {
        getType() {
            return "jws_tab"
        }
    }
    elementor.elementsManager.registerElementType(new e)
    
})); 