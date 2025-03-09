<?php

// 查询博客
function queryBlog($id) {
    if (!$id) {
        return null;
    }
    
    $blog = DB::selectFirst("SELECT * FROM blogs WHERE id = " . (int)$id);
    if (!$blog) {
        return null;
    }
    
    // 获取作者信息
    $poster = DB::selectFirst("SELECT username FROM user_info WHERE username = '" . DB::escape($blog['poster']) . "' COLLATE utf8mb4_unicode_ci");
    if ($poster) {
        $blog['poster_username'] = $poster['username'];
    } else {
        $blog['poster_username'] = $blog['poster'];
    }
    
    return $blog;
}

// 查询博客标签
function queryBlogTags($blog_id) {
    $tags = [];
    $result = DB::select("SELECT tags.name FROM tags 
                         INNER JOIN blogs_tags ON tags.id = blogs_tags.tag_id 
                         WHERE blogs_tags.blog_id = {$blog_id}");
    
    foreach ($result as $tag) {
        $tags[] = $tag['name'];
    }
    
    return $tags;
}

// 更新博客标签
function updateBlogTags($blog_id, $tags_str) {
    // 删除现有标签
    DB::delete("DELETE FROM blogs_tags WHERE blog_id = {$blog_id}");
    
    // 添加新标签
    $tag_arr = explode(',', $tags_str);
    foreach ($tag_arr as $tag) {
        $tag = trim($tag);
        if (!$tag) {
            continue;
        }
        
        $res = DB::select("SELECT id FROM tags WHERE name = '".DB::escape($tag)."'");
        if (count($res) == 0) {
            DB::insert("INSERT INTO tags (name) VALUES ('".DB::escape($tag)."')");
            $tag_id = DB::insert_id();
        } else {
            $tag_id = $res[0]['id'];
        }
        
        DB::insert("INSERT INTO blogs_tags (blog_id, tag_id) VALUES ({$blog_id}, {$tag_id})");
    }
}

// 插入新博客
function insertBlog($blog_data) {
    $title = DB::escape($blog_data['title']);
    $content = DB::escape($blog_data['content']);
    $poster = DB::escape($blog_data['poster']);
    $type = DB::escape($blog_data['type']);
    $is_hidden = (int)$blog_data['is_hidden'];
    
    DB::insert("INSERT INTO blogs (title, content, poster, type, post_time, is_hidden) 
                VALUES ('{$title}', '{$content}', '{$poster}', '{$type}', NOW(), {$is_hidden})");
    
    return DB::insert_id();
}

// 更新博客
function updateBlog($blog_id, $blog_data) {
    $updates = [];
    
    if (isset($blog_data['title'])) {
        $updates[] = "title = '" . DB::escape($blog_data['title']) . "'";
    }
    
    if (isset($blog_data['content'])) {
        $updates[] = "content = '" . DB::escape($blog_data['content']) . "'";
    }
    
    if (isset($blog_data['type'])) {
        $updates[] = "type = '" . DB::escape($blog_data['type']) . "'";
    }
    
    if (isset($blog_data['is_hidden'])) {
        $updates[] = "is_hidden = " . (int)$blog_data['is_hidden'];
    }
    
    if (!empty($updates)) {
        DB::update("UPDATE blogs SET " . implode(', ', $updates) . " WHERE id = {$blog_id}");
        return true;
    }
    
    return false;
} 