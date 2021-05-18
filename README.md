# Fitnessapp

This is a proof of concept I made for uni. It's a crud system that let's you add, edit, read and delete exercises. I made this project in early 2020.

## Installation

This project uses composer for certain packages.

```bash
composer install
```

## Documentation

### Database design

The database design is not fully integrated but it shows a full picture of what I intended to have.

![image](https://user-images.githubusercontent.com/11200658/118701238-c5f52980-b813-11eb-80eb-a87f68c41ae8.png)

### Architecture

For this project I used an n-tier architecture to seperate the project into multiple layers. I also applied interfaces and dependency inversion.

![image](https://user-images.githubusercontent.com/11200658/118701420-fdfc6c80-b813-11eb-912a-b264bba6b05d.png)

- **UI Layer** carries all the information shown to the end user.
- **Logic Layer** Will prepare/clean data send to either the UI or the DAL layer.
- **DAL (Data Access Layer)** This layer talks to the database to store/update/delete or read rows.

### Testing

I applied basic unit tests unfortunately I only really scratched the surface of what I could've and should've tested.

## License
[MIT](https://choosealicense.com/licenses/mit/)
