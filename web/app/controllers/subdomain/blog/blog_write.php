<?php
requirePHPLib('form');

// 添加调试输出
error_log("====== 博客写作页面加载 ======");
error_log("REQUEST_URI: " . $_SERVER['REQUEST_URI']);
error_log("博客用户名: " . (isset($_GET['blog_username']) ? $_GET['blog_username'] : '未设置'));
error_log("博客ID: " . (isset($_GET['id']) ? $_GET['id'] : '新博客'));

// 检查博客权限
if (!UOJContext::hasBlogPermission()) {
    become403Page();
}

// 初始化博客变量
$blog = null;
$blog_content = '';
$blog_tags = '';
$blog_title = '';
$blog_type = 'B';
$problem_id = '';

// 如果是编辑现有博客
if (isset($_GET['id'])) {
    if (!validateUInt($_GET['id']) || !($blog = queryBlog($_GET['id'])) || !UOJContext::isHis($blog)) {
        become404Page();
    }
    $blog_content = $blog['content'];
    $blog_title = $blog['title'];
    $blog_type = $blog['type'];
    
    $blog_tags_array = queryBlogTags($blog['id']);
    $blog_tags = implode(', ', $blog_tags_array);
    
    if ($blog['is_hidden']) {
        $blog_level = '关闭';
    } else {
        $blog_level = '公开';
    }
}

// 创建博客编辑表单
$blog_editor = new UOJForm('blog_editor');
$blog_editor->addInput('title', 'text', '标题', $blog_title, 
    function($title) {
        if (!$title) {
            return '标题不能为空';
        }
        if (strlen($title) > 100) {
            return '标题不能超过100个字';
        }
        return '';
    }, 
    null
);

// 添加博客类型选择
$blog_editor->addSelect('type', [
    'B' => '博客',
    'S' => '题解'
], '类型', $blog_type);

// 添加标签输入
$blog_editor->addInput('tags', 'text', '标签', $blog_tags, 
    function($tags) {
        $tag_arr = explode(',', $tags);
        foreach ($tag_arr as $tag) {
            $tag = trim($tag);
            if (!$tag) {
                continue;
            }
            if (strlen($tag) > 30) {
                return '标签不能超过30个字';
            }
            if (!preg_match('/^[a-zA-Z0-9\x{4e00}-\x{9fa5}_\-\.]+$/u', $tag)) {
                return '标签不合法';
            }
        }
        return '';
    }, 
    null
);

// 添加博客内容编辑器
$blog_editor->addTextArea('content', '内容', $blog_content, 
    function($content) {
        if (strlen($content) > 1000000) {
            return '内容过长';
        }
        return '';
    }, 
    null
);

// 处理博客保存
$blog_editor->handle = function() {
    global $blog, $myUser;
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $type = $_POST['type'];
    $tags = $_POST['tags'];
    
    $blog_id = -1;
    
    // 保存博客
    if ($blog) {
        // 更新现有博客
        DB::update("update blogs set title = '".DB::escape($title)."', content = '".DB::escape($content)."', type = '{$type}', is_hidden = 0 where id = {$blog['id']}");
        $blog_id = $blog['id'];
    } else {
        // 创建新博客
        DB::insert("insert into blogs (title, content, poster, type, post_time, is_hidden) values ('".DB::escape($title)."', '".DB::escape($content)."', '".Auth::id()."', '{$type}', now(), 0)");
        $blog_id = DB::insert_id();
    }
    
    // 更新标签
    if ($blog_id != -1) {
        DB::delete("delete from blogs_tags where blog_id = {$blog_id}");
        $tag_arr = explode(',', $tags);
        foreach ($tag_arr as $tag) {
            $tag = trim($tag);
            if (!$tag) {
                continue;
            }
            
            $res = DB::select("select id from tags where name = '".DB::escape($tag)."'");
            if (count($res) == 0) {
                DB::insert("insert into tags (name) values ('".DB::escape($tag)."')");
                $tag_id = DB::insert_id();
            } else {
                $tag_id = $res[0]['id'];
            }
            
            DB::insert("insert into blogs_tags (blog_id, tag_id) values ({$blog_id}, {$tag_id})");
        }
        
        // 重定向到博客页面
        redirectTo(HTML::blog_url(UOJContext::userid(), "/post/{$blog_id}"));
    }
};

$blog_editor->submit_button_config['text'] = $blog ? '保存更改' : '发表博客';
$blog_editor->succ_href = '/';

$blog_editor->runAtServer();
?>

<?php echoUOJPageHeader(($blog ? '编辑' : '写') . '博客') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $blog ? '编辑' : '写' ?>博客</h3>
    </div>
    <div class="card-body">
        <?php $blog_editor->printHTML(); ?>
    </div>
</div>

<?php echoUOJPageFooter() ?>
