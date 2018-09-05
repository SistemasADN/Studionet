var pdf_export = {
    os_name:"{os.name}",
    init:function()
    {
        var settings = {header:null,footer:null,margin:null};
        settings.margin = {
            top:document.body.style.marginTop?document.body.style.marginTop:"0px",
            left:document.body.style.marginLeft?document.body.style.marginLeft:"0px",
            right:document.body.style.marginRight?document.body.style.marginRight:"0px",
            bottom:document.body.style.marginBottom?document.body.style.marginBottom:"0px"
        };
        document.body.style.margin = "0px";
        if(pdf_export.os_name=="linux")
        {
            document.body.className += " linux";
        }
        var el = document.querySelector('div.page-header');
        if(el)
        {
            if(pdf_export.os_name=="linux")
            {
                el.style.zoom = 0.5;    
            }
            settings.header = {
                contents: el.outerHTML,
                height:el.style.height?el.style.height:'25px',
            };
            el.parentNode.removeChild(el);
        }
        var el = document.querySelector('div.page-footer');
        if(el)
        {
            if(pdf_export.os_name=="linux")
            {
                el.style.zoom = 0.5;    
            }
            settings.footer = {
                contents: el.outerHTML,
                height:el.style.height?el.style.height:'25px',
            };
            el.parentNode.removeChild(el);
        }
        return settings;
    }
}