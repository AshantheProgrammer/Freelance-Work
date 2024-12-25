# utility_functions.py

import csv
import pandas as pd
import matplotlib.pyplot as plt

# Task A Functions
# -----------------

# Load data using csv module
def load_data_csv(file_path):
    """
    Loads data from a CSV file using the csv module and stores it in a list.
    Args:
        file_path (str): Path to the CSV file.
    Returns:
        list: Data loaded into a list of rows.
    """
    with open(file_path, mode='r') as file:
        reader = csv.reader(file)
        data = [row for row in reader]
    return data

# Load data using pandas
def load_dataframe(file_path):
    """
    Loads data from a CSV file into a pandas DataFrame.
    Args:
        file_path (str): Path to the CSV file.
    Returns:
        pd.DataFrame: Data loaded into a DataFrame.
    """
    return pd.read_csv(file_path)

# Retrieve demographic information
def get_demographics(data, patient_id):
    """
    Retrieves demographic information based on patient ID.
    Args:
        data (list): List of patient data.
        patient_id (str): Patient ID to search for.
    Returns:
        dict or str: Demographic information or a message if not found.
    """
    for row in data[1:]:  # Skip header row
        if row[0] == patient_id:
            return {
                "Age": row[1],
                "Gender": row[2],
                "Smoking History": row[3],
                "Ethnicity": row[9]
            }
    return "Patient ID not found."

# Retrieve top treatments for an ethnicity with survival > 100 months
def top_treatments(dataframe, ethnicity):
    """
    Identifies the top 3 treatments for a specified ethnicity where patients survived > 100 months.
    Args:
        dataframe (pd.DataFrame): DataFrame containing the dataset.
        ethnicity (str): Ethnicity to filter by.
    Returns:
        pd.Series: Top 3 treatments and their counts.
    """
    filtered_df = dataframe[(dataframe['Ethnicity'] == ethnicity) & (dataframe['Survival_Months'] > 100)]
    return filtered_df['Treatment'].value_counts().head(3)

# Retrieve custom information
def get_custom_info(data, systolic_threshold, glucose_threshold):
    """
    Retrieves patient information based on custom conditions.
    Args:
        data (list): List of patient data.
        systolic_threshold (int): Minimum systolic blood pressure.
        glucose_threshold (float): Minimum glucose level.
    Returns:
        list: Matching patients' information.
    """
    results = []
    for row in data[1:]:  # Skip header row
        if int(row[20]) > systolic_threshold and float(row[34]) > glucose_threshold:
            results.append({
                "Patient ID": row[0],
                "Blood Pressure Systolic": row[20],
                "Glucose Level": row[34],
                "Survival Months": row[8]
            })
    return results if results else "No data found for the specified conditions."

# Task C Functions
# -----------------

# Proportion of cancer treatments among a certain ethnicity
def plot_treatment_proportion(dataframe, ethnicity):
    """
    Creates a pie chart showing the proportion of treatments for a given ethnicity.
    Args:
        dataframe (pd.DataFrame): DataFrame containing the dataset.
        ethnicity (str): Ethnicity to filter by.
    """
    filtered_df = dataframe[dataframe['Ethnicity'] == ethnicity]
    treatment_counts = filtered_df['Treatment'].value_counts()
    
    plt.figure(figsize=(8, 6))
    plt.pie(treatment_counts, labels=treatment_counts.index, autopct='%1.1f%%', startangle=90)
    plt.title(f"Proportion of Cancer Treatments Among {ethnicity} Patients")
    plt.show()

# Trend of average smoking packs consumption across stages for each ethnicity
def plot_smoking_trend_by_stage(dataframe):
    """
    Creates a line chart showing the trend of smoking packs across cancer stages for each ethnicity.
    Args:
        dataframe (pd.DataFrame): DataFrame containing the dataset.
    """
    avg_smoking_by_stage_ethnicity = dataframe.groupby(['Stage', 'Ethnicity'])['Smoking_Pack_Years'].mean().unstack()
    
    plt.figure(figsize=(10, 6))
    for ethnicity in avg_smoking_by_stage_ethnicity.columns:
        plt.plot(avg_smoking_by_stage_ethnicity.index, avg_smoking_by_stage_ethnicity[ethnicity], marker='o', label=ethnicity)
    
    plt.title("Trend of Average Smoking Packs Across Cancer Stages for Each Ethnicity")
    plt.xlabel("Cancer Stage")
    plt.ylabel("Average Smoking Packs")
    plt.legend(title="Ethnicity")
    plt.grid(True)
    plt.show()

# Comparison of average blood pressure across treatments
def plot_blood_pressure_comparison(dataframe):
    """
    Creates a bar chart comparing average blood pressure across different treatments.
    Args:
        dataframe (pd.DataFrame): DataFrame containing the dataset.
    """
    avg_blood_pressure = dataframe.groupby('Treatment')[['Blood_Pressure_Systolic', 'Blood_Pressure_Diastolic', 'Blood_Pressure_Pulse']].mean()
    
    avg_blood_pressure.plot(kind='bar', figsize=(12, 6), alpha=0.8)
    plt.title("Comparison of Average Blood Pressure Types Across Treatments")
    plt.xlabel("Treatment Type")
    plt.ylabel("Average Blood Pressure")
    plt.legend(title="Blood Pressure Type")
    plt.grid(axis='y')
    plt.xticks(rotation=45)
    plt.show()

# Custom visualization - Average tumor size by tumor location across treatments
def plot_avg_tumor_size_by_location(dataframe):
    """
    Creates a bar chart showing average tumor size by tumor location for each treatment.
    Args:
        dataframe (pd.DataFrame): DataFrame containing the dataset.
    """
    avg_tumor_size = dataframe.groupby(['Treatment', 'Tumor_Location'])['Tumor_Size_mm'].mean().unstack()
    
    avg_tumor_size.plot(kind='bar', figsize=(10, 6), alpha=0.8)
    plt.title("Average Tumor Size by Tumor Location Across Treatments")
    plt.xlabel("Treatment Type")
    plt.ylabel("Average Tumor Size (mm)")
    plt.legend(title="Tumor Location")
    plt.grid(axis='y')
    plt.xticks(rotation=45)
    plt.show()
