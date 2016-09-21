
/**
 * [Page js分页]
 * @param {[type]} op [description]
 */
var Page = function(op){
    //  不允许直接调用
    if(this instanceof Page){
        this.ini_page(op);
    }else{
        return new Page(op);
    }
}
Page.prototype = {
    container_ID : 'pageList',
    f_btn : '',             //  首页按钮
    l_btn : '',             //  尾页按钮
    pre_btn : '',            //  上一页&laquo;
    next_btn : '',           //  下一页&raquo;
    h_btn : '',          //  省略页
    total_page : 20,        //  总页数
    page_showNums : 5,      //  显示页数
    now_page : 1,           //  当前页
    callback : function(){},    //  利用回调函数取指定数据
    is_ajax : true,             //  是否采用异步
    page_href : 'http://%page%',
    obj_name : null,
    show_total: true,       //显示总页数

    is_selector : true,
    go_btn : '',             //  跳转按钮

    //input_btn:'<input id="curp" class="curp" name="curpage" type="text" size="1" />',
    input_btn:'',
    //
    //  初始化 option = {container_ID:容器ID , f_btn:首页 , l_btn:尾页 , h_btn:省略的页 , total_page:总页数 , page_showNums:显示几页 ,  callback:回调函数}
    //
    ini_page : function(option){
        var op = arguments[0];
        if(op){
            for(var i in op){
                if(typeof op[i] != 'undefined'){
                    this[i] = op[i];
                }
            }
        }

        if(this.total_page < 1 || this.page_showNums < 1){
            $('#'+ this.container_ID).hide();
            return;
        }
        this.create_pagelist(this.container_ID);
    },

    create_pagelist : function(container_ID){
        var pagelist_html = '';
        pagelist_html += this.page_list_a(this.f_btn);
        pagelist_html += this.page_list_a(this.pre_btn);
        
        var pre_show = Math.ceil(this.page_showNums / 2) - 1;
        if(pre_show < 1)pre_show = 1;
        var start_page = this.now_page - pre_show;              //  前排始终显示pre_show页
        var last_page_start = this.total_page - this.page_showNums + 1; //  最后一行页列表起始页
        if(start_page < 1)start_page = 1;
        if(last_page_start < 1)last_page_start = 1;
        if(start_page > last_page_start)start_page = last_page_start;

        if( start_page > 1){
            //pagelist_html += this.page_list_a(1);
            //if(start_page > 2){
                pagelist_html += this.page_list_a(this.h_btn);
            //}
        }

        for(var i=0; i<this.page_showNums; i++){
            if(start_page > this.total_page)break;
            pagelist_html += this.page_list_a(start_page++);
        }

        if( start_page <= this.total_page ){
            if( start_page < this.total_page ){
                pagelist_html += this.page_list_a(this.h_btn);
            }
            //pagelist_html += this.page_list_a(this.total_page , container_ID);
        }
        pagelist_html += this.page_list_a(this.next_btn);
        pagelist_html += this.page_list_a(this.l_btn);
        
        
        // if( this.is_selector ){
        //     //下拉菜单列表
        //     this.input_btn="<select class=\"selector arrow\" onchange=\""+ this.obj_name +".gotoPage_click(this,"+container_ID+")\">";
        //     for(var i=1;i<=this.total_page;i++){
        //         if(i==this.now_page){
        //             this.input_btn+="<option value=\""+i+"\" selected=\"selected\">"+i+"</option>";
        //         }else{
        //             this.input_btn+="<option value=\""+i+"\">"+i+"</option>";
        //         }
        //     }
        //     this.input_btn+="</select>";
            
        //     pagelist_html += this.page_list_a(this.input_btn);
            
        if( this.show_total ){
            //页码标识
            this.go_btn = this.now_page +'/'+ this.total_page;
            pagelist_html += this.page_list_a(this.go_btn);
        }
        // }

        // document.getElementById(this.container_ID).innerHTML = pagelist_html;
        $('#'+ this.container_ID).html(pagelist_html);

        $('#'+ this.container_ID).show();
    },

    page_list_a : function(c){

        //  ajax
        var href = '';
        if(this.is_ajax){
            href = 'javascript:;';
        }else{
            href = this.page_href.replace('%page%', c);

            //  设置next,pre按钮是否可点 和 样式
            if(this.now_page <= 1 && c == this.pre_btn){
                href = 'javascript:;';
            }
            if(this.now_page >=  this.total_page && c == this.next_btn ){
                href = 'javascript:;';
            }
            if( c == this.f_btn ) href = this.page_href.replace('%page%', '1');
            if( c == this.l_btn ) href = this.page_href.replace('%page%', this.total_page);
        }


        var event_bind='';
        if( this.is_ajax && c!=this.input_btn && c!=this.go_btn){
            event_bind = ' onclick="'+ this.obj_name +'.page_click(\''+ c +'\' , this);" ';
        }
        
        //if(c==this.go_btn){
        //  event_bind = ' onclick="'+ this.obj_name +'.gotoPage_click(\''+ c +'\' , this);" ';
        //}
        
        if (c == '') {
            return '';
        }else if(c == this.now_page){
            return '<li class="active"><a href="'+ href +'">'+ c +'</a></li>';
        }else if(c == this.h_btn){
            return '<li><a href="#">'+ c +'</a></li>';
        }
        // else if(c == this.pre_btn){
        //     return '<li '+ event_bind +'><a href="'+ href +'">&laquo;</a></li>';
        // }else if(c == this.next_btn){
        //     return '<li '+ event_bind +'><a href="'+ href +'">&raquo;</a></li>';
        // }
        else if(c == this.go_btn){
            return '<li><a href="#">'+ c +'</a></li>';
        }else{
            return '<li '+ event_bind +'><a href="'+ href +'">'+ c +'</a></li>';
        }

    },
    
    gotoPage_click : function(obj,o){
        var goPage = $(obj).val();
        this.page_click(goPage, o);
    },
    
    page_click : function(c , o){
        var page , container_ID = $(o).parent().attr('id');
        if(c == this.f_btn){
            page = 1;
        }else if(c == this.l_btn){
            page = this.total_page;
        }else if(c == this.pre_btn){
            page = this.now_page - 1;
        }else if(c == this.next_btn){
            page = (+this.now_page) + 1;
        }else{
            page = c;
        }
        page = page > this.total_page ? this.total_page : (page < 1 ? 1 : page);

        this.now_page = page;
        this.ini_page();
        //  AJAX
        if(typeof this.callback == 'function'){
            this.callback(this.now_page);
        }
    }
};


