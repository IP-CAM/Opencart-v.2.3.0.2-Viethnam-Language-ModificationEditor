<?php
class ModelConfigLinkSeo extends Model {

    // List Link Seo
	public function getLinkSeo($data = array()) {
	    $sql = "SELECT * FROM " . DB_PREFIX . "url_alias WHERE url_alias_id > 0";

	   if (!empty($data['filter_query'])) {
			$sql .= " AND query LIKE '" . $this->db->escape($data['filter_query']) . "%'";
		}

		if (!empty($data['filter_keyword'])) {
			$sql .= " AND keyword LIKE '" . $this->db->escape($data['filter_keyword']) . "%'";
		}

	    $sql .= " ORDER BY keyword ASC";

	    if (isset($data['start']) || isset($data['limit'])) {
	        if ($data['start'] < 0) {
	            $data['start'] = 0;
	        }

	        if ($data['limit'] < 1) {
	            $data['limit'] = 20;
	        }

	        $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	    }


	    $query = $this->db->query($sql);

	    return $query->rows;
	}

	// Total Link Seo
	public function getTotalLinkSeo() {
	    $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "url_alias");

	    return $query->row['total'];
	}

	// Delete Link Seo
	public function deleteLinkSeo($url_alias_id) {
	    $this->event->trigger('pre.admin.seo.delete', $url_alias_id);
	    $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE url_alias_id = '".(int)$url_alias_id."'");

	    $this->cache->delete('seo');

	    $this->event->trigger('post.admin.seo.delete', $url_alias_id);
	}

    // Get query, keyword
    public function getInfoSeo($id) {
        // Câu lệnh cải tiến : mysqli.php
        return $this->db->where('url_alias_id', $id)->row(['query', 'keyword'], 'url_alias');
    }

    // Update
    public function update($id, $data) {
        if(!empty($data)) {
            // Câu lệnh cải tiến : mysqli.php
            $status = $this->db->where('url_alias_id', $id)->update('url_alias', $data);
        }
        return $status;
    }

    public function insert($table, $data) {
        if(!empty($data)) {
            // Câu lệnh cải tiến : mysqli.php
            $id = $this->db->insert($table, $data);
        }
        echo $this->db->getLastQuery();
       // return $id;
    }

}
