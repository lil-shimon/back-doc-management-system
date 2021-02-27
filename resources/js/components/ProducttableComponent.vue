<template>
  <div>
    <div class="o-modal" id="overlay" v-show="showContent">
      <div class="is-dialog">
        <div class="o-modal__content">
          <div class="o-modal__content__title">
            <h2>新規登録</h2>
          </div>
          <div class="o-modal__content__body">
            <div class="o-form">
              <div class="o-form__title">名前</div>
              <input type="text" name value v-model="editedItem['name']" tabindex="1"/>
            </div>
            <div class="o-form">
              <div class="o-form__title">単位</div>
              <!-- <input type="text" name value class="is-min" v-model="editedItem['unit']"/> -->
              <select v-model="editedItem['unit']" tabindex="2">
                        <option value>-</option>
                        <option value="式">式</option>
                        <option value="ヶ月">ヶ月</option>
                        <option value="個">個</option>
                        <option value="枚">枚</option>
                      </select>
            </div>
            <div class="o-form">
              <div class="o-form__title">単価</div>
              <!-- <input type="text" name value class="is-min" v-model="editedItem['unit_price']" tabindex="3"/> -->
              <currency-input 
                        locale="ja" 
                        :currency="null"
                        :precision=0
                        v-model="editedItem['unit_price']"
                        style="text-align:right;"
                        tabindex="3">
              </currency-input>
            </div>
            <div class="o-form">
              <div class="o-form__title">税</div>
              <!-- <input type="text" name value class="is-min" v-model="editedItem['tax']"/> -->
              <select v-model="editedItem['tax']" tabindex="4">
                        <option value>-</option>
                        <option value="0.1">10%</option>
                        <option value="0.08">8%</option>
                        <option value="0.05">5%</option>
                        <option value="0">対象外</option>
                      </select>
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
        <div class="p-setting__content__btn" v-on:click="openModal(-1)">
          <button type="button" class="o-btn is-ore">新規登録</button>
        </div>
        <div class="o-table is-setting">
          <table>
            <tr>
              <th class="is-no">No.</th>
              <th class="is-name">名前</th>
              <th>単位</th>
              <th class="is-unit">単価</th>
              <th>税</th>
              <th class="is-edit">編集</th>
              <th>削除</th>
            </tr>
            <tr v-for="(item, index) in product_table_items" :key="item.id">
              <td class="is-no">{{ index+1 }}</td>
              <td class="is-name">{{ item.name }}</td>
              <td>{{ item.unit }}</td>
              <td class="is-unit" style="text-align: right;">{{ item.unit_price.toLocaleString() }}</td>
              <td>{{ item.tax * 100 }}%</td>
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
      editedIndex: -1,
      editedItem: {
        name: "",
        unit_price: 0,
        unit: "",
        tax: ""
      },
      defaultItem: {
        name: "",
        unit_price: 0,
        unit: "",
        tax: ""
      },
      product_table_items: []
    };
  },

  mounted: function() {
    this.getDocItems();
  },

  methods: {
    getDocItems: function() {
      axios.get("/api/product").then(res => {
        this.product_table_items = res.data;
      });
    },
    save() {
      if (this.editedIndex != -1) {
        this.product_table_items.splice(this.editedIndex, 1);
      }
      axios.post("/api/product", { editItem: this.editedItem });
      this.editedItem["id"] = this.product_table_items.slice(-1)[0]["id"] + 1;
      this.product_table_items.push(this.editedItem);
      this.closeModal();
    },
    openModal: function(ind) {
      if (ind != -1){
        this.editedItem = this.product_table_items[ind]
      }
      this.editedIndex = ind;
      this.showContent = true;
    },
    closeModal: function() {
      this.editedItem = this.defaultItem;
      this.showContent = false;
    },
    delete_item: function(pid) {
      axios.delete("/api/product/" + pid);
      var delete_index = this.product_table_items.findIndex(
        ({ id }) => id == pid
      );
      this.product_table_items.splice(delete_index, 1);
    },
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