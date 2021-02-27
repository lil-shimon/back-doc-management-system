<template>
  <div>
    <div class="o-modal" id="overlay" v-show="showContent">
      <div class="is-dialog">
          <div class="o-modal__content">
            <div class="o-modal__content__title"><h2>新規登録</h2></div>
            <div class="o-modal__content__body">
              <div class="o-form">
                <div class="o-form__title">名前</div>
                <input type="text" name="" value="" v-model="editedItem['name']" tabindex="1">
              </div>
              <div class="o-form">
                <div class="o-form__title">画像</div>
                <input type="file" name="" class="is-file" :src="editedItem['img_path']" @change="selectedFile" tabindex="2">
              </div>
            </div>
            <div class="o-modal__content__btn">
              <button type="button" class="o-btn is-grey" v-on:click="closeModal">キャンセル</button>
              <button type="submit" class="o-btn" v-on:click="save">登録</button>
            </div>
          </div>
        </div>
    </div>

    <div class="is-body_content__main">
      <div class="p-setting__content">
        <!-- <div class="p-setting__content__btn">
          <button type="button" class="o-btn is-ore" v-on:click="openModal(-1)">新規登録</button>
        </div> -->
        <div class="o-table is-setting">
          <table>
            <tr>
              <th class="is-no">No.</th>
              <th class="is-name">名前</th>
              <th>画像</th>
              <th class="is-edit">編集</th>
              <th width="60">削除</th>
            </tr>
            <tr v-for="(item, index) in company_logo_table_items" :key="item.id">
              <td class="is-no">{{ index+1 }}</td>
              <td class="is-name">{{ item.name }}</td>
              <td>
                <img  :src="'storage/' + item.img_path" />
              </td>
              <td class="is-edit">
                <button type="button" class="o-btn" v-on:click="openModal(index)">編集</button>
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
</template>

<script>
export default {
  data() {
    return {
      showContent: false,
      imageData: "",
      imgfilename: "",
      editedIndex: -1,
      editedItem: {
        name: "",
        img_path: null
      },
      defaultItem: {
        name: "",
        img_path: null
      },
      company_logo_table_items: []
    };
  },

  mounted: function() {
    this.getDocItems();
  },

  methods: {
    getDocItems: function() {
      axios.get("/api/company-logo").then(res => {
        this.company_logo_table_items = res.data;
      });
    },

    selectedFile: function(e) {
      this.imageData = e.target.files[0];
      if (!this.imageData.type.match("image.*")) {
          this.confirmedImage = "";
          return;
      }
    },

    save() {
      if (this.editedIndex != -1) {
        this.company_logo_table_items.splice(this.editedIndex, 1);
      }
      let data = new FormData();
      data.append("file", this.imageData);
      data.append("title", this.editedItem["name"]);
      axios.post("/api/company-logo", data);
      this.company_logo_table_items.push(this.editedItem);
      this.closeModal();
    },
    openModal: function(ind) {
      if (ind != -1){
        this.editedItem = this.company_logo_table_items[ind]
      }
      this.showContent = true;
    },
    closeModal: function() {
      this.editedItem = this.defaultItem;
      this.showContent = false;
    },
    delete_item: function(cid) {
      axios.delete("/api/company-logo/" + cid);
      var delete_index = this.company_logo_table_items.findIndex(
        ({ id }) => id == cid
      );
      this.company_logo_table_items.splice(delete_index, 1);
    }
  }
};
</script>
<style>
#overlay {
  /*　要素を重ねた時の順番　*/
  z-index: 1;

  /*　画面全体を覆う設定　*/
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);

  /*　画面の中央に要素を表示させる設定　*/
  display: flex;
  align-items: center;
  justify-content: center;
}

input:focus,
textarea:focus,
select:focus {
	background-color: #d9f6ff;
}
</style>