<template>
  <div class="content-wrapper is-add_style">
    <div class="main_content p-quote">
      <div class="is-body_content">
        <h1 class="is-body_content__title">項目登録</h1>
        <div class="is-body_content__main">
          <div class="p-quote__content">
            <div class="p-quote__content__tab">
              <ul>
                <li v-on:click="show_doc_type_id = 0">
                  <a v-if="show_doc_type_id != 0">全て</a>
                  <a v-if="show_doc_type_id == 0" class="is-active">全て</a>
                </li>
                <li v-on:click="show_doc_type_id = 1">
                  <a v-if="show_doc_type_id != 1">お見積り</a>
                  <a v-if="show_doc_type_id == 1" class="is-active">お見積り</a>
                </li>
                <li v-on:click="show_doc_type_id = 2">
                  <a v-if="show_doc_type_id != 2">納品書</a>
                  <a v-if="show_doc_type_id == 2" class="is-active">納品書</a>
                </li>
                <li v-on:click="show_doc_type_id = 3">
                  <a v-if="show_doc_type_id != 3">請求書</a>
                  <a v-if="show_doc_type_id == 3" class="is-active">請求書</a>
                </li>
                <li v-on:click="show_doc_type_id = 4">
                  <a v-if="show_doc_type_id != 4">領収書</a>
                  <a v-if="show_doc_type_id == 4" class="is-active">領収書</a>
                </li>
              </ul>
              <!-- <ul>
                <li v-on:click="is_show_trash_file = 0">
                  <a v-if="is_show_trash_file != 0">書類</a>
                  <a v-if="is_show_trash_file == 0" class="is-active">書類</a>
                </li>
                <li v-on:click="is_show_trash_file = 1">
                  <a v-if="is_show_trash_file != 1">ゴミ箱</a>
                  <a v-if="is_show_trash_file == 1" class="is-active">ゴミ箱</a>
                </li>
              </ul> -->
            </div>
            <form class action method="post">
              <div class="p-quote__content__search">
                <!-- <div class="o-form">
                  <input type="text" name value placeholder="テキスト入力" />
                  <button type="button" class="o-btn is-icon">
                    <i class="icon is-search"></i>
                  </button>
                </div>-->
              </div>
              <div class="p-quote__content__select">
                <ul>
                  <li>
                    <div class="o-form">
                      <select v-model="select_items[0]">
                        <option value="-1">売識</option>
                        <option value="1">S</option>
                        <option value="2">R</option>
                      </select>
                    </div>
                  </li>
                  <li>
                    <div class="o-form">
                      <select v-model="select_items[1]">
                        <option value="-1">見識</option>
                        <option value="1">F</option>
                        <option value="2">A</option>
                        <option value="3">K</option>
                        <option value="4">J</option>
                        <option value="5">C</option>
                      </select>
                    </div>
                  </li>
                  <li>
                    <div class="o-form">
                      <select v-model="select_items[2]">
                        <option value="-1">客識</option>
                        <option value="1">G</option>
                        <option value="2">A</option>
                        <option value="3">R</option>
                      </select>
                    </div>
                  </li>
                  <!-- <li>
                    <div class="o-form">
                      <select v-model="select_items[3]">
                        <option value="-1">ステータス</option>
                        <option value="0">未</option>
                        <option value="1">済</option>
                      </select>
                    </div>
                  </li> -->
                </ul>
              </div>
            </form>
            <div class="o-table is-quote">
              <table>
                <tr>
                  <th width="50">No.</th>
                  <th width="60">売識</th>
                  <th width="60">見識</th>
                  <th width="60">客識</th>
                  <th class="is-type">種類</th>
                  <th class="is-name">担当者</th>
                  <th>タイトル</th>
                  <!-- <th class="is-name">ステータス</th> -->
                  <th class="is-edit" v-if="is_show_trash_file == 0">複製編集</th>
                  <th class="is-edit" v-if="is_show_trash_file == 1">修復</th>
                  <th class="is-edit">プレビュー</th>
                  <th width="60">削除</th>
                </tr>
                <tr v-for="item in document_table_items" :key="item.id">
                  <td>{{ item.id }}</td>
                  <td>{{ item.sell_part_label }}</td>
                  <td>{{ item.see_part_label }}</td>
                  <td>{{ item.customer_part_label }}</td>
                  <td class="is-type">{{ item.document_type_label }}</td>
                  <td class="is-name">{{ item.users.name }}</td>
                  <td class="is-title">{{ item.document_title }}</td>
                  <!-- <td class="is-name"><button type="button" class="btn btn-light" v-on:click="changestatus(item.id, item.status)">{{ item.status_label }}</button></td> -->
                  <td class="is-edit" v-if="is_show_trash_file == 0">
                    <router-link :to="{name: 'form', params: {doc_id: item.id}}" style="color: white"><button type="button" class="o-btn">編集</button></router-link>
                  </td>
                  <td v-if="is_show_trash_file == 1">
                    <button type="button" class="o-btn" v-on:click="restore(item.id)">修復</button>
                  </td>
                  <td class="is-edit">
                    <router-link
                      :to="{ name: 'preview', query: {doc_id: item.id}}"
                      style="color: white"
                    >
                      <button type="button" class="o-btn is-blue_d">プレビュー</button>
                    </router-link>
                  </td>
                  <td>
                    <button type="button" class="o-btn is-icon" v-on:click="delete_item(item.id)">
                      <i class="icon is-trash"></i>
                    </button>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      show_doc_type_id: 0,
      is_show_trash_file: 0,
      select_items: [-1, -1, -1, -1],
      document_table_items: [],
    };
  },

  mounted: function() {
    this.getDocItems();
  },

  methods: {
    getDocItems: function() {
      axios.get("/api/document").then(res => {
        this.document_table_items = res.data;
      });
    },

    resetSort: function() {
      for (var ind = 0; ind < this.select_items.length; ind++) {
        this.select_items[ind] = "-1";
      }
    },

    show_select_item: function() {
      axios
        .get("/api/get-narrow-down-doc", {
          params: {
            show_doc_type_id: this.show_doc_type_id,
            select_items: this.select_items,
            is_show_trash: this.is_show_trash_file
          }
        })
        .then(res => {
          this.document_table_items = res.data;
        });
    },

    delete_item: function(doc_id) {
      var alert_text = this.is_show_trash_file == 1 ? "\n完全に削除されます。" : "\nゴミ箱に移動します。"
      if (confirm("削除しますか?" + alert_text)){
        axios.delete("/api/document/" + doc_id);
        var delete_index = this.document_table_items.findIndex(
          ({ id }) => id == doc_id
        );
        this.document_table_items.splice(delete_index, 1);
      }
    },

    changestatus: function(doc_id, status) {
      axios.get("/api/change-status", {
        params: {
          id: doc_id,
          status: status
        }
      });
      for (var i = 0; i < this.document_table_items.length; i++){
        if (this.document_table_items[i]["id"] == doc_id){
          if (status == 0){
            this.document_table_items[i]["status_label"] = "済"
            this.document_table_items[i]["status"] = 1
          }
          else {
            this.document_table_items[i]["status_label"] = "未"
            this.document_table_items[i]["status"] = 0
          }
        }
      }
    },

    restore: function(doc_id) {
      axios.get("/api/restore", {
        params: {
          id: doc_id
        }
      });
      var delete_index = this.document_table_items.findIndex(
        ({ id }) => id == doc_id
      );
      this.document_table_items.splice(delete_index, 1);
    }
  },

  watch: {
    show_doc_type_id: function(newval, oldval) {
      this.show_select_item();
      this.resetSort();
    },
    select_items: function(newval, oldval) {
      this.show_select_item();
      // this.resetSort();
    },

    is_show_trash_file: function(newval, oldval) {
      this.show_select_item();
      this.resetSort();
    }
  }
};
</script>

<style>
td {
  text-align: center;
}

select:focus {
	background-color: #d9f6ff;
}
</style>
