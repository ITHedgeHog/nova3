vue = {
	data: {
		key: ""
	},

	methods: {
		checkKey: function () {
			if (this.key != "") {
				var url = Nova.data.keyCheckUrl
				var postData = { key: this.key }

				this.$http.post(url, postData).then(response => {
					if (response.data.code == 0) {
						this.key = ""

						swal({
							title: "Error!",
							text: "Menu keys must be unique. Another menu is already using the key [" + postData.key + "]. Please enter a unique key.",
							type: "error",
							timer: null,
							html: true
						})
					}
				}, response => {
					this.key = ""

					swal({
						title: "Error!",
						text: "There was an error trying to check the menu key. Please try again. (Error " + response.status + ")",
						type: "error",
						timer: null,
						html: true
					})
				})
			}
		}
	}
}