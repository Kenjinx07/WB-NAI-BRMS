from flet import *
import flet as ft
import os 
import cv2
import numpy as np
import pytesseract
import pandas as pd
import matplotlib.pyplot as plt
import re
from PIL import Image as img
import easyocr

def processingtheimage(e, page, image_loc, id_number, lname_txt, gname_txt, mname_txt, b_date, address, image_preview):
    img_pro = img.open(image_loc.value)

    reader = easyocr.Reader(['en'])
    result = reader.readtext(image_loc.value)

    text = '\n'.join([entry[1] for entry in result])

    print(text)
    with open("result.text", "w") as file:
        file.write(text)

    sections = {}
    lines = text.split("\n")
    current_section = ''

    for line in lines:
        if line.strip() == "":
            continue

        if "Apilyedo/Last Name" in line:
            current_section = "section_6"
        elif "Mga Pangalan/Given Names" in line:
            current_section = "section_10"
        elif "Gitnang Apilyedo/Middle Name" in line:
            current_section = "section_11"
        elif "Petsa ng Kapanganakan/Date of Birth" in line:
            current_section = "section_13"
        elif "Tirahan/Address" in line:
            current_section = "section_17"
        else:
            current_section = f"section_{len(sections) + 1}"

        sections[current_section] = line.strip()

    print(sections)

    id_number.value = sections.get('section_5', '') 
    lname_txt.value = sections.get('section_7', '')
    gname_txt.value = sections.get('section_9', '')
    mname_txt.value = sections.get('section_10', '')

    dob = sections.get('section_11', '')
    data_regex = re.compile(r'\b(?:JANUARY|FEBRUARY|MARCH|APRIL|MAY|JUNE|JULY|AUGUST|SEPTEMBER|OCTOBER|NOVEMBER|DECEMBER)\s+\d{1,2},\s+\d{4}\b', re.IGNORECASE)
    matches = data_regex.findall(dob)
    if matches:
        my_bdate = matches[0]
        b_date.value = my_bdate
    else:
        print("No date of birth found!")

    address_lines = [sections.get(f'section_{i}', '') for i in range(14, 17)]
    complete_address = ' '.join(address_lines)
    address.value = complete_address.strip()
    
    image_preview.src = f"{os.getcwd()}/{image_loc.value}"

    page.snack_bar = SnackBar(
        Text("Success: Image processed", size=30),
        bgcolor="green"
    )
    page.snack_bar.open = True
    page.update()
    
def main(page:Page):
    page.scroll = "auto"

    image_loc = TextField(label="Image name")
    id_number = TextField(label="ID Number")
    lname_txt = TextField(label="Last name")
    gname_txt = TextField(label="First name")
    mname_txt = TextField(label="Middle name")
    b_date = TextField(label="Birth date")
    address = TextField(label="Address")

    image_preview = Image(src=False, width=150, height=120)

    page.add(
        Column([
            image_loc,
            ElevatedButton("Process Image",
                bgcolor="blue", color="white",
                on_click=lambda e: processingtheimage(e, page, image_loc, id_number, lname_txt, gname_txt, mname_txt, b_date, address, image_preview)
            ),
            Text("Resulting Image", weight="bold"),
            image_preview,
            id_number,
            lname_txt,
            gname_txt,
            mname_txt,
            b_date,
            address              
        ])
    )


ft.app(target=main)