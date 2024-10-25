const sidebar = document.getElementById("sidebar");
const toggleSidebar = document.getElementById("toggleSidebar");
const toggleTheme = document.getElementById("toggleTheme");
const body = document.body;

toggleSidebar.addEventListener("click", () => {
  sidebar.classList.toggle("minimized");
});

toggleTheme.addEventListener("click", () => {
  body.classList.toggle("dark-mode");
  const isDarkMode = body.classList.contains("dark-mode");
  toggleTheme.innerHTML = isDarkMode
    ? '<i class="fas fa-sun"></i>'
    : '<i class="fas fa-moon"></i>';
});

function showUpdateForm(type, data) {
  const container = document.getElementById("updateFormContainer");
  const form = document.getElementById("updateForm");
  const title = document.getElementById("updateFormTitle");

  // Clear previous form fields
  form.innerHTML = "";

  // Set the form title
  title.textContent = type.charAt(0).toUpperCase() + type.slice(1);

  // Add hidden input for ID
  const idInput = document.createElement("input");
  idInput.type = "hidden";
  idInput.name = "id";
  idInput.value = data.id;
  form.appendChild(idInput);

  // Add form fields based on the type
  if (type === "product") {
    addFormField(form, "name", "text", "Product Name", data.name);
    addFormField(
      form,
      "description",
      "textarea",
      "Description",
      data.description
    );
    addFormField(form, "price", "number", "Price", data.price, {
      step: "0.01",
    });
    addFormField(form, "size", "text", "Size", data.size);
    addFormField(form, "stock", "number", "Stock", data.stock);
    addFormField(form, "image_url", "text", "Image URL", data.image_url);
  } else if (type === "user") {
    addFormField(form, "name", "text", "Name", data.name);
    addFormField(form, "email", "email", "Email", data.email);
    addFormField(form, "role", "select", "Role", data.role, {
      options: [
        { value: "customer", label: "Customer" },
        { value: "admin", label: "Admin" },
      ],
    });
  } else if (type === "order") {
    addFormField(form, "user_id", "number", "User ID", data.user_id);
    addFormField(form, "product_ids", "text", "Product IDs", data.product_ids);
    addFormField(
      form,
      "total_price",
      "number",
      "Total Price",
      data.total_price,
      { step: "0.01" }
    );
    addFormField(
      form,
      "order_status",
      "text",
      "Order Status",
      data.order_status
    );
    addFormField(
      form,
      "payment_info",
      "text",
      "Payment Info",
      data.payment_info
    );
  }

  // Add submit button
  const submitButton = document.createElement("input");
  submitButton.type = "submit";
  submitButton.name = `update_${type}`;
  submitButton.value = "Update";
  form.appendChild(submitButton);

  // Show the form container
  container.style.display = "block";
}

function hideUpdateForm() {
  document.getElementById("updateFormContainer").style.display = "none";
}

function addFormField(form, name, type, placeholder, value, options = {}) {
  const label = document.createElement("label");
  label.textContent = placeholder;
  form.appendChild(label);

  let input;
  if (type === "select") {
    input = document.createElement("select");
    options.options.forEach((option) => {
      const optionElement = document.createElement("option");
      optionElement.value = option.value;
      optionElement.textContent = option.label;
      optionElement.selected = option.value === value;
      input.appendChild(optionElement);
    });
  } else if (type === "textarea") {
    input = document.createElement("textarea");
    input.value = value;
  } else {
    input = document.createElement("input");
    input.type = type;
    input.value = value;
  }

  input.name = name;
  input.placeholder = placeholder;

  for (const [key, value] of Object.entries(options)) {
    if (key !== "options") {
      input[key] = value;
    }
  }

  form.appendChild(input);
}
